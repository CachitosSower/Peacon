@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h3>Documento {{$documento->titulo}} <a href="{{url('trabajo/'.$id_trabajo.'/documento/'.$documento->id.'/edit')}}" role="button" class="btn btn-warning">Modificar</a></h3>
                <br>
                <form action="{{ url('documento') }}" method="post" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" placeholder="titulo documento" name="titulo" value="{{$documento->titulo}}">
                    </div>
                    <div class="form-group">
                        <label for="fecha_emision">Fecha emisión del documento</label>
                        <input type="date" class="form-control" id="fecha_emision" placeholder="fecha de publicación" name="fecha_emision" value="{{$documento->fecha_emision}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario</label>
                        <br>
                        <textarea name="comentario" cols="104" rows="5" disabled><?= $documento->comentario; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Nombre documento</label>
                        <input type="text" class="form-control" id="titulo" placeholder="titulo documento" name="titulo" value="{{$documento->archivo}}" disabled>
                    </div>
                    <input type="hidden" name="id_trabajo" value="{{$id_trabajo}}">
                    <div class="form-group">
                    </div>
                </form>
                <br><br><br>
            </div>
        </div>
    </div>
@endsection
