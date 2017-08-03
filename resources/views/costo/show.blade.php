@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/trabajo/'.$id_trabajo) }}">Trabajo</a></li>
                    <li class="active">Detalles de costo</li>
                </ol>
            </div>
            <h1>Detalle de costos  <a href="{{url('/trabajo/'.$costo->id_trabajo.'/costo/'.$costo->id.'/edit')}}" role="button" class="btn btn-success btn-sm pull-right">Modificar</a></h1>
            <h2><strong>{{ $costo->descripcion }}</strong></h2><br>
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

            <div class="row peacon-block">
                <div class="col-sm-12">
                    <a href="{{ url('trabajo/'.$id_trabajo.'/costo/'.$costo->id.'/item/create') }}" role="button" class="btn btn-success btn-sm pull-right">Agregar item</a>
                </div>
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

                            <th style="text-align:center">Opciones</th>
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

                                <td style="text-align:center">
                                    {{ Form::open(['url' => '/trabajo/'.$costo->id_trabajo.'/costo/'.$costo->id.'/item/'.$item->id, 'onsubmit' => "return confirm('¿Seguro que deseas eliminar el archivo? Esta acción es irreversible!');"]) }}
                                    <a href="{{url('/trabajo/'.$costo->id_trabajo.'/costo/'.$costo->id.'/item/'.$item->id.'/edit')}}" role="button" class="btn btn-default btn-xs">Modificar</a>
                                    {{ Form::submit(' X ', ['class' => 'btn btn-danger btn-xs']) }}
                                    {{ method_field('DELETE') }}
                                    {{ Form::close() }}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row peacon-block">
                <div class="col-sm-12">
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
    </div>
@endsection
