<div class="card">

    @section('title', 'Dashboard')

    @section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.posts.create')}}">Nuevo post</a>

    <h1>Categorias</h1>
    @stop

{{--     @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif --}}
    <div class="card-body">

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->slug }}</td>
                    <td>
                {{--  <button wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Edit</button> --}}
                    <button wire:click="delete({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

