@extends('layouts.app')

@section('content')

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Trabajos</a></li>
                <li class="active">Trabajo de prueba</li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="co-sm-12">
                <h1>{{$work->descripcion}} <a href="{{url('/trabajo/modificar/'.$work->id)}}" role="button" class="btn btn-warning">Modificar</a> </h1>
                <h4><strong>{{$work->empresa}}</strong> :: RUT {{$work->rut}}</h4>
            </div>
        </div>

        <div class="row peacon-block peacon-costos">
            <h1>Definiciones de costos <a href="#" role="button" class="btn btn-success">Agregar nueva</a></h1>
            <table class="work_list table-hover">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Costo</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                    <!-- ASDASDASD -->
                </tbody>
            </table>
        </div>

        <div class="row peacon-block">
            <h1>Cotizaciones generadas <a href="#" role="button" class="btn btn-success">Generar nueva</a></h1>
            <table class="work_list table-hover">
                <thead>
                <tr>
                    <th>Sel</th>
                    <th>Descripción</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Valor total</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td><a href="#">{{$work->description}}</a></td>
                    <td>$ {{ number_format($work->cost, 0, ",", ".") }}</td>
                    <td>Nada =)</td>
                    <td>Nada =)</td>
                    <td>Nada =)</td>
                    <td>Nada =)</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
