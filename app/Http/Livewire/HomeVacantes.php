<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Illuminate\Queue\Listener;
use Livewire\Component;

class HomeVacantes extends Component
{

    public $termino;
    public $categoria;
    public $salario;
    
    protected $listeners=['terminosBusqueda'=>'filtrar'];

    public function filtrar($termino, $categoria, $salario)
    {
        $this->termino=$termino;
        $this->categoria=$categoria;
        $this->salario=$salario;
    }
    public function render()
    {   
        //$vacantes= Vacante::paginate(5);
        $vacantes=Vacante::when($this->termino, function($query){
            $query->where('titulo', 'LIKE','%'. $this->termino.'%');
        })
        ->when($this->termino, function($query){
            $query->orWhere('empresa', 'LIKE','%'. $this->termino.'%');
         })
        ->when($this->categoria, function($query){
           $query->where('categoria_id',$this->categoria); 
        })
        ->when($this->salario, function($query){
            $query->where('salario_id',$this->salario); 
         })
        ->paginate(1);

        return view('livewire.home-vacantes',[
            "vacantes"=>$vacantes
        ]);
    }
}
