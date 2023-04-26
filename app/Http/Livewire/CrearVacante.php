<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected $rules=[
        'titulo'=> 'required|string',
        'salario'=>'required',
        'categoria'=>'required',
        'empresa'=>'required',
        'ultimo_dia'=>'required',
        'descripcion'=>'required',
        'imagen'=>'required|image|max:1024',
    ];

    public function render()
    {
       


        //consultar base de datos
        $salarios= Salario::all();//we are using the model (This is with eloquent [ORM])

        $categorias= Categoria::all();

        return view('livewire.crear-vacante',
        [
            "salarios"=>$salarios,
            "categorias"=>$categorias
        ]);
    }

    public function crearVacante()
    {
        $datos= $this->validate();

        //guardarImagen
    
        $imagen= $this->imagen->store('public/vacantes');//guarda la imagen en la ruta dada

        $nombre_imagen= str_replace('public/vacantes/','', $imagen);

        //crear la vacante
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $nombre_imagen,
            'user_id' => auth()->user()->id
        ]);

        //mensaje de confirmacion
        session()->flash('mensaje','La vacante ha sido creada');

        //redireccion a la pantalla de vacantes

        redirect()->route('vacantes.index');
    }
}
