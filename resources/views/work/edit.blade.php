@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Trabajos</a></li>
                <li class="active">Trabajo de prueba</li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="col-sm-8 col-sm-offset-2">
                <h1>Modificando trabajo trabajo</h1><br>

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

                {{ Form::open(array('url' => 'trabajo/update/'.$work->id)) }}

                <div class="form-group">
                    {{ Form::label('descripcion', 'Descripción del trabajo') }}
                    {{ Form::text('descripcion', $work->descripcion, array('class' => 'form-control', 'placeholder' => 'Descripción de la empresa')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('empresa', 'Empresa') }}
                    {{ Form::text('empresa', $work->empresa, array('class' => 'form-control', 'placeholder' => 'Nombre de la empresa')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('rut', 'RUT') }}
                    {{ Form::text('rut', $work->rut, array('class' => 'form-control', 'placeholder' => 'Ej. 76608248-3')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('estado', 'Estado') }}
                    {!! Form::select('estado', [1 => 'Activo', 0 => 'Inactivo', 2 => 'Finalizado', -1 => 'Desechado'], $work->estado, ['class' => 'form-control']) !!}
                </div>
                <div class="pull-right">
                    <a href="{{url('/trabajo/'.$work->id)}}" role="button" class="btn btn-default ">Volver</a>
                    {{ Form::submit('Modificar trabajo', array('class' => 'btn btn-primary')) }}
                </div>

                {{ Form::close() }}
            </div>
        </div>


    </div>
@endsection
