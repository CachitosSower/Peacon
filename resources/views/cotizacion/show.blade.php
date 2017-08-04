@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Inicio</a></li>
                <li><a href="{{url('trabajo/'.$id_trabajo)}}">Trabajo</a></li>
                <li class="active">Detalles de cotizacion</li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="col-sm-12">
                <h1>Detalles para la cotización
                    <a href="{{ route('trabajo.costo.cotizacion.edit', [$id_trabajo, $id_costo, $cotizacion->id]) }}" role="button" class="btn btn-primary btn-sm pull-right margin-15-left">Modificar</a>
                    <a href="{{url('/trabajo/'.$costo->id_trabajo)}}" role="button" class="btn btn-default btn-sm pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Volver</a>
                </h1>

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
                <hr class="col-sm-12">
                <h3>Basado en la siguiente definición de costos</h3>
                <h4><strong>{{ $costo->descripcion }}</strong></h4>
                <div class="col-sm-12" style="border: 1px solid #999;">
                    <div class="row peacon-block">
                        <div class="col-sm-12">
                            <table class="table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Prov</th>
                                    <th>Encargo</th>
                                    <th>Cant</th>
                                    <th>Costo</th>
                                    <th>Precio</th>
                                    <th>Desc %</th>
                                    <th>Desc</th>
                                    <th>Total</th>
                                    <th>IVA</th>
                                    <th>Bruto</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($itemes as $item)
                                    <tr>
                                        <td>{{ Form::checkbox('proveedor', '', $item->es_proveedor, ['disabled']) }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->cantidad }}</td>
                                        <td>{{ formatear_dinero($item->costo) }}</td>
                                        <td>{{ formatear_dinero($item->precio) }}</td>
                                        <td>{{ $item->descuento_porcentual }}</td>
                                        <td>{{ formatear_dinero($item->descuento_bruto) }}</td>
                                        <td>{{ formatear_dinero($item->total) }}</td>
                                        <td>{{ formatear_dinero($item->iva) }}</td>
                                        <td><strong>{{ formatear_dinero($item->bruto) }}</strong></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row peacon-block">
                        <div class="col-sm-8 col-sm-offset-4">
                            <table class="table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Total neto</th>
                                    <th>Descuento</th>
                                    <th>IVA</th>
                                    <th>Total bruto</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ formatear_dinero($neto) }}</td>
                                    <td>{{ formatear_dinero($desc) }}</td>
                                    <td>{{ formatear_dinero($iva) }}</td>
                                    <td><strong>{{ formatear_dinero($total) }}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr class="col-sm-12">

                <div class="form-group col-sm-6">
                    <h5 style="margin-bottom: 0;">Nombre del contacto</h5>
                    <h3 style="margin-top: 0;">{{ $cotizacion->nombre }}</h3>
                </div>
                <div class="form-group col-sm-6">
                    <h5 style="margin-bottom: 0;">Correo electrónico</h5>
                    <h3 style="margin-top: 0;">{{ $cotizacion->correo }}</h3>
                </div>
                <div class="form-group col-sm-6">
                    <h5 style="margin-bottom: 0;">Teléfono de contacto</h5>
                    <h3 style="margin-top: 0;">{{ $cotizacion->telefono }}</h3>
                </div>
                <div class="form-group col-sm-6">
                    <h5 style="margin-bottom: 0;">Aprobado por</h5>
                    <h3 style="margin-top: 0;">{{ $usuario->name }}</h3>
                </div>

                <div class="form-group col-sm-6">
                    <h5 style="margin-bottom: 0;">Válida desde</h5>
                    <h3 style="margin-top: 0;">{{ formatear_fecha($cotizacion->fecha_emision) }}</h3>
                </div>
                <div class="form-group col-sm-6">
                    <h5 style="margin-bottom: 0;">Válida hasta</h5>
                    <h3 style="margin-top: 0;">{{ formatear_fecha($cotizacion->fecha_vencimiento) }}</h3>
                </div>
                <div class="form-group col-sm-12">
                    <h5 style="margin-bottom: 0;">Comentario</h5>
                    <h3 style="margin-top: 0;">{{ $cotizacion->comentario }}</h3>
                </div>

            </div>
        </div>


    </div>
@endsection
