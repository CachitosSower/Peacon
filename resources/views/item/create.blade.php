@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <!-- BLOQUE 1: BREADCRUMB -->
            <div class="row"><ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ url('/trabajo/'.$id_trabajo) }}">Trabajo</a></li>
                <li><a href="{{ url('/trabajo/'.$id_trabajo.'/costos/'.$id_costo) }}">Costo</a></li>
                <li class="active">Nuevo Item</li>
            </ol></div>
            <!-- FIN BLOQUE 1 -->

            <h1>Nuevo item</h1><br>

            <!-- BLOQUE 2: ERRORES Y MENSAJES -->
            @if ($errors->any())
                <div class="alert alert-danger"><ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul></div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <!-- FIN BLOQUE 2 -->

            <div class="row peacon-block">
                <div class="col-sm-12">

                    {{ Form::open(['url' => 'trabajo/'.$id_trabajo.'/costo/'.$id_costo.'/item']) }}
                    <div class="form-group row">
                        <div class="col-sm-6">
                            {{ Form::label('nombre', 'Nombre del item') }}
                            {{ Form::text('nombre', '', ['class' => 'form-control col-sm-6', 'placeholder' => 'Nombre del item']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            {{ Form::label('cantidad', 'Cantidad') }}
                            {{ Form::text('cantidad', '', ['class' => 'form-control', 'placeholder' => 'N°']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            {{ Form::label('precio', 'Precio') }}
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {{ Form::text('precio', '', ['class' => 'form-control', 'placeholder' => 'Precio']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            {{ Form::label('descuento_bruto', 'Descuento bruto') }}
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {{ Form::text('descuento_bruto', '', ['class' => 'form-control', 'placeholder' => 'Descuento']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            {{ Form::label('descuento_porcentual', 'Descuento porcentual') }}
                            <div class="input-group">
                                <span class="input-group-addon">%</span>
                                {{ Form::selectRange('descuento_porcentual', 0, 100, 0, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>
                                {{ Form::checkbox('es_proveedor', 1, false) }}
                                Este item corresponde a un producto comprado a un proveedor externo.
                            </label>
                        </div>
                    </div>
                    {{ Form::submit('Agregar', ['class' => 'btn btn-success']) }}
                    {{ Form::close() }}

                </div>
            </div>

        </div>
    </div>
@endsection
