@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.users.create')}}">Nuevo usuario</a>

    <h1>Lista de usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
