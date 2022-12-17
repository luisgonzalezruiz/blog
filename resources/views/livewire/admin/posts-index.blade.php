<div class="card">

    <div class="card-header">
        <input wire:model="search" class="form-control" placeholder="Ingrese el nombre del post" />
    </div>

    @if ($posts->count())
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->name }}</td>
                                <td with="10px">
                                    <a class="btn btn-primary btn-xs"
                                        href="{{ route('admin.posts.edit', $post) }}">Editar</a>
                                </td>
                                <td with="10px">
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-xs">Eliminar</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
        <div class="card-footer">
            {{ $posts->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay nimgun registro</strong>
        </div>
    @endif



</div>
