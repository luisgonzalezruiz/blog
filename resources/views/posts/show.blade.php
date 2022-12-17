<x-app-layout>

    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-600">{{$post->name}}</h1>
        <div class="text-lg text-gray-500 mb-2">
            {!! $post->extract !!}
        </div>
        {{-- a partir de una pantalla grande ocupar grid 3, sino gripo 1, asi lo hacemos responsivo --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- contenido principal, a partir de una pantalla grande ocupa dos columna lg:col.... --}}
            <div class=" lg:col-span-2">
                <figure>
                    {{-- usamos la clase Storage::url para acceder a la carpeta storage/public de nuestra aplicacion --}}
                    @if($post->image)
                        <img class="w-full h-80 object-covert object-center" src="{{Storage::url($post->image->url)}}" alt="">
                    @else
                        <img class="w-full h-80 object-covert object-center" src="https://cdn.pixabay.com/photo/2022/02/28/15/28/sea-7039471_960_720.jpg" alt="">
                    @endif

                </figure>
                <div class="text-base text-gray-500 mt-4">
                    {!! $post->body !!}
                </div>

            </div>

            {{-- contenido relacionado --}}
            <aside>

                <h1 class="text-2xl font-bold text-gray-600 mb-4">Mas en {{ $post->category->name}} </h1>

                <ul>
                    {{-- iteramos el array similares que viene del controlador --}}
                    @foreach($similares as $similar)
                        <li class="mb-4">
                            <a class="flex" href="{{ route('posts.show',$similar)}}">

                                @if($similar->image)
                                    <img class="flex-initial w-40 h-25 object-cover object-center" src="{{Storage::url($similar->image->url)}}" alt="">
                                @else
                                    <img class="flex-initial w-40 h-25 object-cover object-center" src="https://cdn.pixabay.com/photo/2022/02/28/15/28/sea-7039471_960_720.jpg" alt="">
                                @endif

                                <span class="ml-2 text-gray-600">{{$similar->name}}</span>
                            </a>

                        </li>
                    @endforeach
                </ul>

            </aside>

        </div>

    </div>

</x-app-layout>
