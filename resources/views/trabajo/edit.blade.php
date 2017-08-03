@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li class="active">Editar trabajo</li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="col-sm-8 col-sm-offset-2">
                <h1>Modificando trabajo</h1><br>

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

                {{ Form::open(array('url' => 'trabajo/'.$trabajo->id)) }}

                <div class="form-group">
                    {{ Form::label('descripcion', 'Descripción del trabajo') }}
                    {{ Form::text('descripcion', $trabajo->descripcion, array('class' => 'form-control', 'placeholder' => 'Descripción de la empresa')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('empresa', 'Empresa') }}
                    {{ Form::text('empresa', $trabajo->empresa, array('class' => 'form-control', 'placeholder' => 'Nombre de la empresa')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('rut', 'RUT') }}
                    {{ Form::text('rut', $trabajo->rut, array('class' => 'form-control', 'placeholder' => 'Ej. 76608248-3')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('estado', 'Estado') }}
                    {!! Form::select('estado', [1 => 'Activo', 0 => 'Inactivo', 2 => 'Finalizado', -1 => 'Desechado'], $trabajo->estado, ['class' => 'form-control']) !!}
                </div>
                <div class="pull-right">
                    <a href="{{url('/trabajo/'.$trabajo->id)}}" role="button" class="btn btn-default ">Volver</a>
                    {{ Form::submit('Modificar trabajo', array('class' => 'btn btn-primary')) }}
                </div>
                {{ method_field('PUT') }}
                {{ Form::close() }}
            </div>
        </div>


    </div>
@endsection
