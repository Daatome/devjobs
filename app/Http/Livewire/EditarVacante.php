<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    public function mount(Vacante $vacante){
        //nombre de las columnas en la base de datos    
        $this->vacante_id=$vacante->id;
        $this->titulo=$vacante->titulo;
        $this->salario=$vacante->salario_id;
        $this->categoria=$vacante->categoria_id;
        $this->empresa=$vacante->empresa;
        $this->ultimo_dia= Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion=$vacante->descripcion;
        $this->imagen=$vacante->imagen;

    }

    public function render()
    {

        
        $salarios= Salario::all();
        $categorias= Categoria::all();

        return view('livewire.editar-vacante',[
            'salarios'=>$salarios,
            'categorias'=>$categorias
        ]);
    }

    use WithFileUploads;

    protected $rules=[
        'titulo'=> 'required|string',
        'salario'=>'required',
        'categoria'=>'required',
        'empresa'=>'required',
        'ultimo_dia'=>'required',
        'descripcion'=>'required',
        'imagen_nueva'=>'nullable|image|max:1024'
    ];

    public function editarVacante(){
        $datos=$this->validate();//datos tiene un arreglo asociativo con el nombre de los campos que se crearon

        //si hay nueva imagen   
        if($this->imagen_nueva)
        {
            $imagen= $this->imagen_nueva->store('public/vacantes');
            ///quitamos el excedente de la ruta
            $imagen= str_replace('public/vacantes','',$imagen);
            //lo asignamos al arreglo asociativo
            $datos['imagen']=$imagen;
            Storage::delete('public/vacantes/'.$this->imagen);
        }

        //encontrar la vacante

        $vacante= Vacante::find($this->vacante_id);

        //asignar los valores
        $vacante->titulo=$datos['titulo'];
        $vacante->salario_id=$datos['salario'];
        $vacante->categoria_id=$datos['categoria'];
        $vacante->empresa=$datos['empresa'];
        $vacante->ultimo_dia=$datos['ultimo_dia'];
        $vacante->descripcion=$datos['descripcion'];
        $vacante->imagen=$datos['imagen'] ?? $vacante->imagen;
        //guardar la vacante

        $vacante->save();
        
        //redireccionar
        session()->flash('mensaje', 'La vacante fue actualizada');

        return redirect()->route('vacantes.index');
    }
}
