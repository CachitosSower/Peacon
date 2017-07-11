@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Lista de costos registrados</h1>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="work_list table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $work)
                            <tr>
                                <td>{{$work->created_at}}</td>
                                <td><a href="#">{{$work->description}}</a></td>
                                <td>$ {{ number_format($work->cost, 0, ",", ".") }}</td>
                                <td>Nada =)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('new-cost', []) }}" class="btn btn-success new-cost" role="button">Angegar nueva definición de costos</a>
            </div>
        </div>
    </div>
@endsection
