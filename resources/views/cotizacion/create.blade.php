@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Inicio</a></li>
                <li><a href="{{url('trabajo/'.$id_trabajo)}}">Trabajo</a></li>
                <li class="active">Nueva cotización</li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="col-sm-12">
                <h1>Creando nueva cotización</h1>

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

                {{ Form::open(['url' => 'trabajo/'.$id_trabajo.'/costo/'.$costo->id.'/cotizacion']) }}

                <div class="form-group col-sm-6">
                    {{ Form::label('nombre', 'Nombre de contacto') }}
                    {{ Form::text('nombre', '', ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('correo', 'Correo de contacto') }}
                    {{ Form::email('correo', '', ['class' => 'form-control', 'placeholder' => 'Correo']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('telefono', 'Teléfono de contacto') }}
                    {{ Form::text('telefono', '', ['class' => 'form-control', 'placeholder' => 'Teléfono']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('id_user', 'Aprobado por') }}
                    {{ Form::select('correo', [1=>'Administrador',2=>'Aníbal Llanos'], 1, ['class' => 'form-control', 'placeholder' => 'Correo']) }}
                </div>

                <div class="form-group col-sm-6">
                    {{ Form::label('fecha_emision', 'Fecha de emisión') }}
                    {{ Form::date('fecha_emision', '', ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('fecha_vencimiento', 'Fecha de vencimiento') }}
                    {{ Form::date('fecha_vencimiento', '', ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-sm-12">
                    {{ Form::label('comentario', 'Comentario') }}
                    {{ Form::textarea('comentario', '', ['class' => 'form-control', 'placeholder' => 'Comentario']) }}
                </div>




                {{ Form::submit('Crear cotización', array('class' => 'btn btn-success')) }}

                {{ Form::close() }}
            </div>
        </div>


    </div>
@endsection
