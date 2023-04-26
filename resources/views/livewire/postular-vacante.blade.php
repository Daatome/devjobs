<div class="bg-gray-100 p-5 mt-10 flex-col justify-center items-center " wire:submit.prevent='postularme' >
    @auth
        
        <h3 class="text-center text-2xl font-bold my-4 ">Postularme a una vacante</h3>
        @if (session()->has('mensaje'))
            <div class="bg-green-300 border-l-4 border-green-600">
                <p class="font-bold">{{session('mensaje')}}</p>
            </div>
        @else
        
            <form class="w-96 mt-5 ">
                <div class="mb-4">
                    <x-input-label for="cv" :value="__('Curriculum Vitae o Hoja de Vida')"></x-input-label>
                    <x-text-input id="cv" class="block mt-1 w-full" wire:model='cv' type="file" accept=".pdf"   />
                    <x-input-error :messages="$errors->get('cv')" class="mt-2" />

                </div>
                <div class="">
                    <x-primary-button class="w-full justify-center">
                        {{ __('Postularme') }}
                    </x-primary-button>
                </div>
            </form>
                
        @endif
    @endauth
    
</div>
