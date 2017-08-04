@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Inicio</a></li>
                <li><a href="{{url('trabajo/'.$id_trabajo)}}">Trabajo</a></li>
                <li class="active">Editando cotización</li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="col-sm-12">
                <h1>Editando cotización</h1>

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

                {{ Form::open(['url' => 'trabajo/'.$id_trabajo.'/costo/'.$id_costo.'/cotizacion/'.$cotizacion->id]) }}

                <div class="form-group col-sm-6">
                    {{ Form::label('nombre', 'Nombre de contacto') }}
                    {{ Form::text('nombre', $cotizacion->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre...']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('correo', 'Correo de contacto') }}
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        {{ Form::text('correo', $cotizacion->correo, ['class' => 'form-control', 'placeholder' => 'Correo...']) }}
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('telefono', 'Teléfono de contacto') }}
                    <div class="input-group">
                        <span class="input-group-addon">+56</span>
                        {{ Form::text('telefono', $cotizacion->telefono, ['class' => 'form-control', 'placeholder' => 'Teléfono...']) }}
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('id_user', 'Aprobado por') }}
                    {{ Form::select('id_user', [1=>'Administrador',2=>'Aníbal Llanos'], 1, ['class' => 'form-control', 'placeholder' => 'Correo...']) }}
                </div>

                <div class="form-group col-sm-6">
                    {{ Form::label('fecha_emision', 'Fecha de emisión') }}
                    {{ Form::date('fecha_emision', $cotizacion->fecha_emision, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('fecha_vencimiento', 'Fecha de vencimiento') }}
                    {{ Form::date('fecha_vencimiento', $cotizacion->fecha_vencimiento, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-sm-12">
                    {{ Form::label('comentario', 'Comentario') }}
                    {{ Form::textarea('comentario', $cotizacion->comentario, ['class' => 'form-control', 'placeholder' => 'Comentario...']) }}
                </div>
                {{ method_field('PUT') }}
                {{ Form::submit('Crear cotización', array('class' => 'btn btn-success')) }}
                {{ Form::close() }}
            </div>
        </div>


    </div>
@endsection
