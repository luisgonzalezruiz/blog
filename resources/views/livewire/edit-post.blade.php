<div>

    <a class="btn btn-green" wire:click="$set('open',true)">
        <i class="fas fa-edit"> </i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar el post
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">

                <div wire:loading wire:target="img" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Imagen cargando! </strong>
                    <span class="block sm:inline">Espere un momento por favor...</span>
                </div>

                @if ($img)
                    {{-- de esta forma recuperamos la imagen seleccionada antes de alzar al server --}}
                    <img class="mb-4" src="{{ $img->temporaryUrl() }}">
                @else
                    <img src="{{ Storage::url($post->img) }}" alt="">
                @endif

                <div class="mb-4">
                    <x-jet-label value="Titulo del post"/>
                    {{-- wire:model.defer: es para que no se renderice todas las veces --}}
                    <x-jet-input type="text" class="w-full" wire:model.defer="post.name"/>

                    @error('post.name')
                        <span>{{$message}}</span>
                    @enderror

                </div>

                <div class="mb-4">
                    <x-jet-label value="Slug"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer="post.slug"/>
                    <x-jet-input-error for="post.slug"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Extracto"/>
                    <textarea class="form-control w-full" row="6" wire:model.defer="post.extract"></textarea>
                    <x-jet-input-error for="post.extract"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Contenido"/>
                    <textarea class="form-control w-full" row="6" wire:model.defer="post.body"></textarea>
                    <x-jet-input-error for="post.body"/>
                </div>

                <div>
                    <input type="file" wire:model="img" id="{{ $identificador }}">
                    <x-jet-input-error for="img"/>
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            {{-- usamos el metodo magico de livewire, a la variable open le asignamos el valor false  --}}
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>

            {{-- de esta forma deshabilitamos el boton cuando se envia o se carga una imagen --}}
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, post.img" class="disabled:opacity-25">
                Actualizar Post
            </x-jet-danger-button>
            {{-- wire:target="metedo a ejecutar" con esto logramos que eso se aplique solo cuando se ejecuta el metodo save --}}
            {{-- <span wire:loading wire:target="save">Cargando...</span> --}}
        </x-slot>

    </x-jet-dialog-modal>

</div>
