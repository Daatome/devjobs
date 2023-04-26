<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" >
        @forelse ($vacantes as $vacante)
            <div class="p-6 text-gray-900 border-b bg-white md:flex md:items-center md:justify-between  ">
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show',$vacante->id) }}" class="font-bold text-lg ">
                        {{$vacante->titulo}}
                    </a>
                    <p class="text-gray-600 font-bold">{{$vacante->empresa}} </p>
                    <p class="text-sm text-gray-400">Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/Y') }} </p>
                </div>
                <div class="flex flex-col md:flex-row gap-3 mt-3">
                    <a href="{{ route('candidatos',$vacante->id) }}" class="rounded-lg font-bold text-white uppercase text-center text-xs bg-black p-2">Candidatos ({{$vacante->candidatos->count()}})</a>
                    <a href="{{ route('vacantes.update',$vacante->id) }}" class="rounded-lg font-bold text-white uppercase text-center text-xs bg-blue-800 p-2">Editar</a>
                    <button wire:click="$emit('mostrarAlerta',{{ $vacante->id}})" class="rounded-lg font-bold text-white uppercase text-center text-xs bg-red-600 p-2">Eliminar</button>
                </div>
            </div>
        @empty
            <p class="text-sm text-center text-gray-800 p-3 font-bold">No hay vacantes que mostrar</p>
        @endforelse
    </div>
    <div class="flex justify-center mt-5">{{$vacantes->links()}} </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        Livewire.on('mostrarAlerta', vacanteId =>{
                Swal.fire({
            title: '¿Estás seguro?',
            text: "No podras recuperar la información de la vacante",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('eliminarVacante', vacanteId);
                Swal.fire(
                'Elminado!',
                'Vacante elminada',
                'success'
                )
            }
            }) 
        });

    </script>
@endpush
