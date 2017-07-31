@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="row">
                <ol class="breadcrumb">
                    <li class="active">Inicio</li>
                </ol>
            </div>
            <h1>Lista de ítemes para la DDC #{{ $id_costo }}  <a href="{{url('/trabajo/nuevo')}}" role="button" class="btn btn-success btn-sm pull-right">Nuevo</a></h1>
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
                            <th>ID costo</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Desc</th>
                            <th>Desc %</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itemes as $item)
                            <tr>
                                <td>{!! $item->id_costo !!}</td>
                                <td>{!! $item->nombre !!}</td>
                                <td>{!! $item->cantidad !!}</td>
                                <td>{!! $item->precio !!}</td>
                                <td>{!! $item->descuento_bruto !!}</td>
                                <td>{!! $item->descuento_porcentual !!}</td>
                                <td style="text-align:center"><a href="#" role="button" class="btn btn-default btn-sm">Detalles</a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection
