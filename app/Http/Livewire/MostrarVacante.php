<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacante extends Component
{
    public $vacante;

    public function render()
    {
        return view('livewire.mostrar-vacante',[
        ]);
    }
}
