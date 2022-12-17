@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar categoria</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            {{-- utilizamos laravel collective --}}
            {!! Form::model($category, ['route' => ['admin.categories.update',$category],'method'=>'put']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', $category->name, ['class'=>'form-control','placeholder'=>'Ingrese nombre de categoria']) !!}
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', $category->slug, ['class'=>'form-control','placeholder'=>'Ingrese nombre de slug','readonly']) !!}
                @error('slug')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {!! Form::submit('Actualizar categoria', ['class'=>'btn btn-primary btn-sm']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
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
@stop
