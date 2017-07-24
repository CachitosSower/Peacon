@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h3>Editar documento</h3>
                <br>
                {!!Form::model($documento,['route' => ['documento.update',$documento -> id],'method' => 'PUT', 'enctype'=> 'multipart/form-data'])!!}

                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" placeholder="titulo documento" name="titulo" value="{{$documento->titulo}}">
                    </div>
                    <div class="form-group">
                        <label for="fecha_emision">Fecha emisión del documento</label>
                        <input type="date" class="form-control" id="fecha_emision" placeholder="fecha de publicación" name="fecha_emision" value="{{$documento->fecha_emision}}">
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario</label>
                        <br>
                        <textarea name="comentario" cols="104" rows="5"><?= $documento->comentario; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Documento</label>
                        <input type="file" class="form-control" id="archivo" placeholder="Subir archivo" name="archivo">
                    </div>
                    {!!Form::submit('Editar',['class' => 'btn btn-success col-md-offset-1'])!!}
                {!!Form::close()!!}
                <br><br><br>
            </div>
        </div>
    </div>
@endsection
