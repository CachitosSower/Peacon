@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="row">
            <ol class="breadcrumb">
                <li class="active">Inicio</li>
            </ol>
        </div>
        <h1>Lista de trabajos  <a href="{{url('/trabajo/nuevo')}}" role="button" class="btn btn-success btn-sm">Nuevo</a></h1>
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
                <table class="table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Trabajo</th>
                        <th>Empresa</th>
                        <th>Fecha creación</th>
                        <th style="text-align:center">DDC</th>
                        <th style="text-align:center">COT</th>
                        <th style="text-align:center">DOC</th>
                        <th style="text-align:center">PAG</th>
                        <th style="text-align:center">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($works as $work)
                        <tr>
                            <td>{!! $work->estado !!}</td>
                            <td>{{$work->descripcion}}</td>
                            <td>{{$work->empresa}}</td>
                            <td>{{$work->created_at}}</td>
                            <td style="text-align:center">{!! Form::checkbox('DDC_'.$work->id, '1', false, []) !!}</td>
                            <td style="text-align:center">{!! Form::checkbox('COT'.$work->id, '1', false, []) !!}</td>
                            <td style="text-align:center">{!! Form::checkbox('DOC'.$work->id, '1', false, []) !!}</td>
                            <td style="text-align:center">{!! Form::checkbox('PAG'.$work->id, '1', false, []) !!}</td>
                            <td style="text-align:center"><a href="{{url('/trabajo/'.$work->id)}}" role="button" class="btn btn-default btn-sm">Detalles</a></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h3>Filtrar trabajos</h3>
                {{ Form::open(array('url' => 'home/filter', 'class' => 'form-inline')) }}
                    <div class="form-group">
                        <label for="filtro_cantidad">Mostrar </label>
                        {!! Form::select('filtro_cantidad', [5 => '5', 10 => '10', 25 => '25', 50 => '50',], 10, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="filtro_estado"> Con estado </label>
                        {!! Form::select('filtro_estado', [99 => 'Todos', 1 => 'Activos', 0 => 'Inactivos', 2 => 'Terminados', -1 => 'Desechados'], $filtro_estado, ['class' => 'form-control']) !!}
                    </div>
                    {{ Form::submit('Filtrar', array('class' => 'btn btn-primary btn-md', 'role' => 'button')) }}
                {{ Form::close() }}


            </div>
        </div>

    </div>
</div>
@endsection
