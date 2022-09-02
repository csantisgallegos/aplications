@extends('adminlte::page')

@section('title', 'Documentación')

@section('content_header')
    <h1>Documentación</h1>
@stop

@section('content')
    <p>Lector de documentación formato json.</p>
    @php
        var_dump($json);
    @endphp
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
