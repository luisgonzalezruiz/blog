<div>
    {{-- usaremos el metodo magico para abrir el modal en lugar de un metodo tradicional --}}
    @can('post.create.lw')
        <x-jet-danger-button wire:click="$set('open',true)">
            crear nuevo post
        </x-jet-danger-button>
    @endcan

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">

                <div wire:loading wire:target="img" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Imagen cargando! </strong>
                    <span class="block sm:inline">Espere un momento por favor...</span>
                </div>

                @if ($img)
                    {{-- de esta forma recuperamos la imagen seleccionada antes de alzar al server --}}
                    <img class="mb-4" src="{{$img->temporaryUrl()}}">
                @endif

                <div class="mb-4">
                    <x-jet-label value="Titulo del post"/>
                    {{-- wire:model.defer: es para que no se renderice todas las veces --}}
                    <x-jet-input type="text" class="w-full" wire:model.defer="name"/>

                    @error('name')
                        <span>{{$message}}</span>
                    @enderror

                </div>

                <div class="mb-4">
                    <x-jet-label value="Slug"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer="slug"/>
                    <x-jet-input-error for="slug"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Extracto"/>
                    <textarea class="form-control w-full" row="6" wire:model.defer="extract"></textarea>
                    <x-jet-input-error for="extract"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Contenido"/>
                    <textarea class="form-control w-full" row="6" wire:model.defer="body"></textarea>
                    <x-jet-input-error for="body"/>
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
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, img" class="disabled:opacity-25">
                Crear Post
            </x-jet-danger-button>

            <x-jet-danger-button wire:click="$emit('alerta','es una prueba')" wire:loading.attr="disabled" wire:target="save, img" class="disabled:opacity-25">
                Crear
            </x-jet-danger-button>

            {{-- wire:target="metedo a ejecutar" con esto logramos que eso se aplique solo cuando se ejecuta el metodo save --}}
            {{-- <span wire:loading wire:target="save">Cargando...</span> --}}
        </x-slot>

    </x-jet-dialog-modal>


</div>

@push('js')

{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

<script>

    Livewire.on('alerta', (param)=> {
        console.log(param);
        //Código que quiero que se ejecute, en este caso la alerta
        //console.log('esto es una prueba')

        /* @this.call('save',(res)=>{
            let data = res
                console.log(data);
        }) */

        // console.log(xx);
       // Swal.fire(
       //     'Buen trabajo desde create-post!',
       //    param,
       //     'success'
       // )

    });

</script>

@endpush


