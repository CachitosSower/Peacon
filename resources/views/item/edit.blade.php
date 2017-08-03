@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/trabajo/'.$id_trabajo) }}">Trabajo</a></li>
                    <li><a href="{{ url('/trabajo/'.$id_trabajo.'/costos/'.$id_costo) }}">Costo</a></li>
                    <li class="active">Editando Item</li>
                </ol>
            </div>
            <h1>Modificando item <strong>{{ $item->nombre }}</strong></h1><br>
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

                    {{ Form::open(['url' => 'trabajo/'.$id_trabajo.'/costo/'.$id_costo.'/item/'.$item->id]) }}
                    <div class="form-group row">
                        <div class="col-sm-6">
                            {{ Form::label('nombre', 'Nombre del item') }}
                            {{ Form::text('nombre', $item->nombre, ['class' => 'form-control col-sm-6', 'placeholder' => 'Nombre del item']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            {{ Form::label('cantidad', 'Cantidad') }}
                            {{ Form::number('cantidad', $item->cantidad, ['class' => 'form-control', 'placeholder' => 'N°']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            {{ Form::label('precio', 'Precio') }}
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {{ Form::number('precio', $item->precio, ['class' => 'form-control', 'placeholder' => 'Precio']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            {{ Form::label('descuento_bruto', 'Descuento bruto') }}
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {{ Form::number('descuento_bruto', $item->descuento_bruto, ['class' => 'form-control', 'placeholder' => 'Descuento']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            {{ Form::label('descuento_porcentual', 'Descuento porcentual') }}
                            <div class="input-group">
                                <span class="input-group-addon">%</span>
                                {{ Form::selectRange('descuento_porcentual', 0, 100, $item->descuento_porcentual, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>
                                {{ Form::checkbox('es_proveedor', 1, $item->es_proveedor) }}
                                Este item corresponde a un producto comprado a un proveedor externo.
                            </label>
                        </div>
                    </div>
                    {{ Form::submit('Modificar', ['class' => 'btn btn-success']) }}
                    {{ method_field('PUT') }}
                    {{ Form::close() }}

                </div>
            </div>

        </div>
    </div>
@endsection
