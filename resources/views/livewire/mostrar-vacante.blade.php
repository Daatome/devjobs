<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3 border-b-2">{{$vacante->titulo}}</h3>

        <div class="md:grid md:grid-cols-2 gap-3 my-5 p-3">
            <p class="uppercase text-gray-800 font-bold ">Empresa: <span class="normal-case font-normal">{{$vacante->empresa}} </span></p>
            <p class="uppercase text-gray-800 font-bold ">Ultimo Dia para postular: <span class="normal-case font-normal">{{$vacante->ultimo_dia->toFormattedDateString()}} </span></p>
            <p class="uppercase text-gray-800 font-bold ">categoria: <span class="normal-case font-normal">{{$vacante->categoria->categoria}} </span></p>
            <p class="uppercase text-gray-800 font-bold ">categoria: <span class="normal-case font-normal">{{$vacante->salario->salario}} </span></p>
        </div>
        
    </div>
    <div class="grid md:grid-cols-6">

        <div class="md:col-span-2">
            <img src="{{asset('storage/vacantes'. $vacante->imagen)}}" alt="imagen {{$vacante->titulo}}" class="w-80">
        </div>
        <div class="md:col-span-4">
            <h2 class="text-xl font-bold">Descripcion del puesto:</h2>
            <p class="text-gray-700">{{$vacante->descripcion}}</p>
        </div>
    </div>
    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>¿Deseas aplicar a esta vacante? <a class="font-bold text-indigo-700 hover:text-indigo-300" href="{{route('register')}}">Obten una cuenta y aplica a esta y otras vacantes</a> </p>
        </div>
    @endguest

    @cannot('create', 'App\\Models\Vacante')
        <livewire:postular-vacante 
            :vacante="$vacante->id"
        />
    @endcannot


        

</div>
