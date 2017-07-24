@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Lista de documentos</h1>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Título</th>
                            <th>Nombre archivo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documentos as $documento)
                            <tr>
                                <td>{{$documento->id}}</td>
                                <td>{{$documento->titulo}}</td>
                                <td>{{$documento->archivo}}</td>
                                <td>{!!link_to_route('documento.show',$title ='Consultar',$parameters = $documento->id,$attributes = ['class' => 'btn  btn-warning btn-xs'])!!}
                                {!!link_to_route('documento.edit',$title ='Editar',$parameters = $documento->id,$attributes = ['class' => 'btn  btn-success btn-xs'])!!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{!!URL::to('/documento/create') !!}" class="btn btn-success" role="button">Agregar nuevo documento</a>
            </div>
        </div>
    </div>
@endsection
