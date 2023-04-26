<div>
    <livewire:filtrar-vacantes></livewire:filtrar-vacantes>
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-4xl text-gray-700 mb-12">Nuestras Vacantes Disponibles</h3>
            <div class="bg-white shadow-sm rounded-lg p-6  divide-y divide-gray-200">
                @forelse ($vacantes as $vacante)
                    <div class="md:flex md:justify-between md:items-center py-5">
                        <div class="md:flex-1">

                            <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-3xl font-extrabold text-gray-600">{{$vacante->titulo}} </a>
                            <p class="text-base text-gray-600 mb-1">{{$vacante->empresa}} </p>
                            <p class="text-base text-gray-600 mb-1">{{$vacante->salario->salario}} </p>
                            <p class="text-base text-gray-400 mb-0">Finaliza en: {{$vacante->ultimo_dia->diffForHumans()}} </p>
                        </div>
                        <div class="mt-5 md:mt-0">
                            <a href="{{ route('vacantes.show', $vacante->id) }}" class="bg-black  p-4 text-center text-white hover:text-gray-400 rounded-lg font-bold block ">Ver vacante</a>
                        </div>
                    </div>
                @empty
                    <p>No hay vacantes aún</p>
                @endforelse

            </div>
        </div>
    </div>
</div>
