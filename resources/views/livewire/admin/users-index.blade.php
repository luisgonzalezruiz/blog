<div>
    <div class="card">

        <div class="card-header">

            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre del post" />

        </div>

        @if ($users->count())
            <div class="card-body">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td with="10px">
                                    <a class="btn btn-primary btn-xs" href="{{route('admin.users.edit', $user)}}">Editar</a>
                                </td>
                                <td with="10px">
                                    <form action="{{route('admin.users.destroy', $user)}}" method="POST">
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
            <div class="card-footer">
                {{$users->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No hay nimgun registro</strong>
            </div>
        @endif
    </div>
</div>
