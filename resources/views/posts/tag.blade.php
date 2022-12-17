
<x-app-layout>

    <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8 py-8">

        <h1 class="uppercase text-base text-3xl font-bold text-gray-500 text-center gap-3">Etiqueta: {{$tag->name}}</h1>

            @foreach($posts as $post)

                <x-card-post :post=$post/>

            @endforeach

        <div>
            {{-- armamos la paginacion --}}
            {{ $posts->links() }}
        </div>

    </div>

</x-app-layout>
