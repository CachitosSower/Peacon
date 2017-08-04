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
                <li><a href="{{url('/')}}">Inicio</a></li>
                <li class="active">Detalles de trabajo</strong></li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="co-sm-12">
                <h1>{{$trabajo->descripcion}} <a href="{{url('/trabajo/'.$trabajo->id.'/edit')}}" role="button" class="btn btn-warning pull-right">Modificar</a> </h1>
                <h4><strong>{{$trabajo->empresa}}</strong> :: RUT {{$trabajo->rut}}</h4>
                <hr>
                <h4>Este trabajo se encuentra {!! $trabajo->estado_string !!}</h4>
                <h4>Este trabajo {!! $trabajo->terminado? 'fue terminado el  <strong>' . $trabajo->fecha_termino . ' </strong>' : 'se encuentra <strong>en desarrollo</strong>' !!}</h4>
            </div>
        </div>

        @include('costo.index')

        <div class="row peacon-block">
            <h1>Cotizaciones generadas <a href="#" role="button" class="btn btn-success pull-right">Generar nueva</a></h1>
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
                    <td><a href="#">{{$trabajo->description}}</a></td>
                    <td>$ {{ number_format($trabajo->cost, 0, ",", ".") }}</td>
                    <td>Nada =)</td>
                    <td>Nada =)</td>
                    <td>Nada =)</td>
                    <td>Nada =)</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row peacon-block">
            <h1>Pagos registrados <a href="#" role="button" class="btn btn-success pull-right">Nuevo</a></h1>
            <table class="work_list table-hover table-bordered">
                <thead>
                <tr>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Medio de pago</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pagos as $pago)
                    <tr>
                        <td>{{$pago->monto}}</td>
                        <td>{{$pago->fecha}}</td>
                        <td>{{$pago->medio_pago}}</td>
                        <td>
                            <a href="{{url('/pago/'.$pago->id)}}" role="button" class="btn btn-default btn-sm">Detalles</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row peacon-block">
            <h1>Documentos subidos <a href="{{url('trabajo/'.$trabajo->id.'/documento/create')}}" role="button" class="btn btn-warning pull-right">Nuevo</a></h1>
            <table class="work_list table-hover table-bordered">
                <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Fecha</th>
                    <th>Comentario</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documentos as $documento)
                    <tr>
                        <td>{{$documento->titulo}}</td>
                        <td>{{formatear_fecha ($documento->fecha_emision)}}</td>
                        <td>{{$documento->comentario}}</td>
                        <td>
                            <a href="{{url('trabajo/'.$trabajo->id.'/documento/'.$documento->id)}}" role="button" class="btn btn-default btn-sm">Detalles</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
