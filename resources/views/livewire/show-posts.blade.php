<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <div class="px-6 py-4 flex items-center">

                {{--  <d flex items-centeriv class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div> --}}

                {{--  <input wire:model="search" type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar post">--}}
                <x-jet-input class="flex-1 mr-4" wire:model="search" type="text" placeholder="Buscar post"></x-input>

                @livewire('create-post')


            </div>

            <x-jet-input class="flex-1 mr-4" wire:model="producto" type="text" placeholder="producto"></x-input>

            <x-jet-danger-button wire:click="agregar"  wire:target="save, img" class="disabled:opacity-25">
                Agregar
            </x-jet-danger-button>

            <br>


            @foreach ($productos as $prod )
                   {{ $prod['id'] }}
            @endforeach

            <x-table>
                @if ($posts->count())
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th wire:click="order('id')"
                                    scope="col"
                                    class=" w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500">
                                    ID

                                    @if ($sort == 'id')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                        @else
                                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort float-right mt-1"></i>
                                    @endif

                                </th>
                                <th wire:click="order('name')"
                                    scope="col"
                                    class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500">
                                    Nombre

                                    @if ($sort == 'name')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                        @else
                                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort float-right mt-1"></i>
                                    @endif

                                </th>
                                <th wire:click="order('slug')" scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500">
                                    Slug
                                </th>
                                <th wire:click="order('category_id')" scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500">
                                    Categoria
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $item)
                                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{$item->id}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$item->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->slug}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->category->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        {{-- a este tipo de componente se lo llama componente de anidamiento --}}
                                        {{-- se crean varias llamadas a componentes como registros haya --}}
                                        {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                        <a class="btn btn-green" wire:click="edit({{ $item }})">
                                            <i class="fas fa-edit"> </i>
                                        </a>

                                        <a class="btn btn-red" wire:click="eliminar({{ $item }})">
                                            <i class="fas fa-edit"> </i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    <div class="card-footer">
                        {{$posts->links()}}
                    </div>
                @else
                    <div class="px-6 py-4">
                       <strong> No existen registros coincidentes!</strong>
                    </div>
                @endif


            </x-table>
    </div>

    <x-jet-dialog-modal wire:model="open_edit">
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
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>

            {{-- de esta forma deshabilitamos el boton cuando se envia o se carga una imagen --}}
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save, post.img" class="disabled:opacity-25">
                Actualizar Post
            </x-jet-danger-button>
            {{-- wire:target="metedo a ejecutar" con esto logramos que eso se aplique solo cuando se ejecuta el metodo save --}}
            {{-- <span wire:loading wire:target="save">Cargando...</span> --}}
        </x-slot>

    </x-jet-dialog-modal>

</div>
