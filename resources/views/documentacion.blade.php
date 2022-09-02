@extends('adminlte::page')

@section('title', 'Documentación')

@section('content_header')
    <h1>Documentación</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            {{-- TITULO --}}
            <div class="col-12">
                <h1>{{ $titulo }}</h1>
            </div>
            {{-- DESCRIPCION --}}
            <div class="col-12">
                <p>{!! $descripcion !!}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            {{-- TITULO VARIABLES DE AMBIENTES --}}
            <div class="col-12">
                <h2>Variables de Ambientes</h2>
            </div>
            {{-- VARIABLES DE AMBIENTES --}}
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Activa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($env as $e)
                            <tr>
                                <td>{{ $e['key'] }}</td>
                                <td>{{ $e['value'] }}</td>
                                <td>{{ $e['enabled'] ? 'SÍ' : 'NO' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        {{-- TITULO AGRUPACION DE ENDPOINT --}}
        <div class="row">
            <div class="col-12">
                <h2>{{ $item[0]['name'] }}</h2>
            </div>
        </div>
        <hr>
        @foreach ($item as $i)
            @foreach ($i['item'] as $ii)
                @php
                    // -----------------------------
                    $piv = $ii;
                    // -----------------------------
                    $ep_titulo = $piv['name'];
                    $ep_metodo = $piv['request']['method'];
                    $ep_url = $piv['request']['url']['raw'];
                    $ep_descripcion = $piv['request']['description'];
                    $ep_header = $piv['request']['header'];
                    // -----------------------------
                    // Parámetros de Cabecera
                    $str_ep_header = '';
                    foreach ($ep_header as $k => $v) {
                        $str_ep_header .= '<code>' . $v['key'] . '</code> : ' . $v['value'] . ' <b>(' . $v['type'] . ')</b> : ' . $v['description'] . '<br>';
                    }
                    $str_ep_header = $str_ep_header == '' ? 'No Aplica' : $str_ep_header;
                    // -----------------------------
                    // URL
                    foreach ($env as $k => $v) {
                        $ep_url = str_replace('{' . '{' . $v['key'] . '}' . '}', $v['value'], $ep_url);
                    }
                    // -----------------------------
                    $ep_response = $piv['response'];
                    // -----------------------------
                @endphp
                <div class="row">
                    <div class="col-12">
                        <h3>{!! $ep_titulo !!}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Método</th>
                                    <td>{{ $ep_metodo }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Parámetros de Cabecera</th>
                                    <td>{!! $str_ep_header !!}</td>
                                </tr>
                                <tr>
                                    <th scope="row">URL</th>
                                    <td>{{ $ep_url }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Descripción</th>
                                    <td>{!! $ep_descripcion !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h4>Listado de Respuestas</h4>
                        @foreach ($ep_response as $r)
                            <div class="list-group">
                                <a class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $r['name'] }}</h5>
                                        {{-- <small>3 days ago</small> --}}
                                    </div>
                                    <div class="p-3 mb-2 bg-dark">
                                        <pre><p style="color: white !important;
                                            font-weight: bold;">{!! $r['body'] !!}</p></pre>
                                    </div>
                                    <small>{!! $r['_postman_previewlanguage'] !!}</small>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @php
                    //dump($ii);
                @endphp
            @endforeach
        @endforeach
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
