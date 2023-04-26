<?php

namespace App\Http\Livewire;

use App\Models\Candidato;
use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;


    public $cv;

    public $vacante;//receiving this from other component

    protected $rules=[
        'cv'=>'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante=$vacante;
    }

    public function postularme()
    {
        $datos=$this->validate();

        //almacenar cv en el disco
        $cv=$this->cv->store('public/cv');
        $datos["cv"]=str_replace('public/cv','',$cv);

        //crear la el candidato... no necesitamos poner la vacante ya que pusimos una relacion de muchos al modelo vacante
        $this->vacante->candidatos()->create([
            'user_id'=>auth()->user()->id,
            'cv'=>$datos["cv"]
        ]);
        //notificacion
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id,$this->vacante->titulo,auth()->user()->id));
        
        //mostrar al usuario que se postuló
        session()->flash('mensaje',"Postulacion Exitosa");
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
