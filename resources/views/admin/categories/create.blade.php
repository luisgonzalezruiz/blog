@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear categoria</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">
            {{-- utilizamos laravel collective --}}
            {!! Form::open(['route'=>'admin.categories.store']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese nombre de categoria']) !!}
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, ['class'=>'form-control','placeholder'=>'Ingrese nombre de slug','readonly']) !!}
                @error('slug')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {!! Form::submit('Crear categoria', ['class'=>'btn btn-primary btn-sm']) !!}

            {!! Form::close() !!}

           {{-- ejemplode de uso de alpine --}}
           <div x-data={mensaje:null}>

               <input type="text" x-model="mensaje">
               <button @click="$refs.msj.innerText=mensaje">enviar</button>
               <p x-ref="msj"></p>

           </div>

        </div>

    </div>

@stop

@section('js')

    {{-- asi incluimos alpine a un formulario en adminlte --}}
    <script src=https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js defer></script>

    {{-- esto esta en la carpeta publi/vendor/....... --}}
    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>

@endsection

