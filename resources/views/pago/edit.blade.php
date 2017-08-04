@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Inicio</a></li>
                <li><a href="{{route('trabajo.show', $id_trabajo)}}">Trabajo</a></li>
                <li class="active">Editando pago</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <h1>Editar Pago</h1>

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

                <br>
                {{ Form::open(array('url' => 'trabajo/'.$id_trabajo.'/pago/'.$pago->id)) }}

                <div class="form-group row">
                    <div class="col-sm-6">
                        {{ Form::label('monto', 'Monto del Pago') }}
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('monto', $pago->monto, ['class' => 'form-control', 'placeholder' => 'Monto del Pago']) }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        {{ Form::label('medio_pago', 'Medio de Pago') }}
                        {{ Form::select('medio_pago', array(1=>'Efectivo',2=>'Cheque',3=>'Débito',4=>'Transferencia'), $pago->medio_pago, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        {{ Form::label('fecha', 'Fecha') }}
                        {{ Form::date('fecha', substr($pago->fecha,0,stripos($pago->fecha,' ')), array('class' => 'form-control')) }}
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{route('trabajo.show', $id_trabajo)}}" role="button" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Volver</a>
                        {{ Form::submit('Editar Pago', array('class' => 'btn btn-primary margin-15-left')) }}
                    </div>
                </div>
                {{ method_field('PUT') }}
                {{ Form::close() }}
                <br><br><br>
            </div>
        </div>
    </div>
@endsection
