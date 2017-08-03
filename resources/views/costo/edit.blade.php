@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Inicio</a></li>
                <li><a href="{{url('trabajo/'.$id_trabajo)}}">Trabajo</a></li>
                <li class="active">Editando definición de costos</li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="col-sm-8 col-sm-offset-2">
                <h1>Modificando item <strong>{{ $costo->nombre }}</strong></h1><br>

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

                {{ Form::open(array('url' => 'trabajo/'.$id_trabajo.'/costo/'.$costo->id)) }}

                <div class="form-group">
                    {{ Form::label('descripcion', 'Descripción del costo a crear') }}
                    {{ Form::text('descripcion', $costo->descripcion, array('class' => 'form-control', 'placeholder' => 'Descripción del costo')) }}
                </div>

                {{ Form::submit('Crear declaración de costos', array('class' => 'btn btn-primary')) }}
                {{ method_field('PUT') }}
                {{ Form::close() }}
            </div>
        </div>


    </div>
@endsection
