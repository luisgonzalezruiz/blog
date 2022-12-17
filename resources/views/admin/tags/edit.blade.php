@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edital Etiqueta</h1>
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
            {{-- Form::model de esta forma el formulario se relaciona al modelo, usa los name como nombre de campo o modelo --}}
            {!! Form::model($tag, ['route' => ['admin.tags.update',$tag],'method'=>'put']) !!}

            @include('admin.tags.partials.form')

            {!! Form::submit('Actualizar etiqueta', ['class'=>'btn btn-primary btn-sm']) !!}

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
