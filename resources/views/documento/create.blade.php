@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
                <h3>Agregar nuevo documento</h3>
                <br>
                <form action="{{ url('trabajo/'.$id_trabajo.'/documento') }}" method="post" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" placeholder="titulo documento" name="titulo" >
                    </div>
                    <div class="form-group">
                        <label for="fecha_emision">Fecha emisión del documento</label>
                        <input type="date" class="form-control" id="fecha_emision" placeholder="fecha de publicación" name="fecha_emision">
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario</label>
                        <br>
                        <textarea name="comentario" cols="104" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Documento</label>
                        <input type="file" class="form-control" id="archivo" placeholder="Subir archivo" name="archivo">
                    </div>
                    <input type="submit" class="btn btn-success" value="Añadir">
                </form>
                <br><br><br>
            </div>
        </div>
    </div>
@endsection
