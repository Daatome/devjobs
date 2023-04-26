<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante' >
    <!-- Email Address -->
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')"  placeholder="titulo de la vacante" />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="salario" :value="__('Salario mensual')" />

        <select wire:model="salario" id="salario" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">--Seleccione una opcion--</option>

            @foreach ($salarios as $salario )
                <option value="{{$salario->id}}">{{$salario->salario}}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="categoria" :value="__('categoría')" />

        <select wire:model="categoria" id="categoria" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            
            <option value="">--Seleccione una opcion--</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}" >{{$categoria->categoria}}</option>
            @endforeach
            
        
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="empresa" :value="__('empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')"  placeholder="Ej. Uber Netflix, Spotify" />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="ultimo_dia" :value="__('ultimo dia para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')"   />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="descripcion" :value="__('descripcion')" />
        <textarea id="descripcion" class="block mt-1 w-full" type="text" wire:model="descripcion" :value="old('descripcion')"  placeholder="Descripcion general del puesto" ></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="imagen" :value="__('imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*" />

        <div class="w-80 my-5">
            @if ($imagen)
                <img src="{{$imagen->temporaryUrl()}}" alt="">
            @endif
        </div>

        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
    </div>

    <x-primary-button>Crear vacante</x-primary-button>

</form>
