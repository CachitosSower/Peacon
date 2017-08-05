@extends('layouts.app')

@section('content')

    <div class="container">

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

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Inicio</a></li>
                <li class="active">Detalles de trabajo</li>
            </ol>
        </div>

        <div class="row peacon-block">
            <div class="co-sm-12">
                <h1>{{$trabajo->descripcion}}
                    <a href="{{url('/trabajo/'.$trabajo->id.'/edit')}}" role="button" class="btn btn-primary pull-right">Modificar</a>
                    <a href="{{url('/')}}" role="button" class="btn btn-default pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Volver</a>
                </h1>
                <h4><strong>{{$trabajo->empresa}}</strong> :: RUT {{$trabajo->rut}}</h4>
                <hr>
                <h4>Este trabajo se encuentra {!! $trabajo->estado_string !!}</h4>
                <h4>Este trabajo {!! $trabajo->terminado? 'fue terminado el  <strong>' . formatear_fecha($trabajo->fecha_termino) . ' </strong>' : 'se encuentra <strong>en desarrollo</strong>' !!}</h4>
            </div>
        </div>

        @include('costo.index')

        <div class="row peacon-block">
            <div class="col-sm-12">
                <h1>Cotizaciones generadas</h1>
                <table class="work_list table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Costo</th>
                        <th>Contacto</th>
                        <th>Emisión</th>
                        <th>Validez</th>
                        <th>Aprobado por</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (count($cotizaciones) > 0)
                            @foreach($cotizaciones as $cotizacion)
                                <tr>
                                    <td>{{ $cotizacion->descripcion_costo }}</td>
                                    <td>{{ $cotizacion->nombre }}</td>
                                    <td>{{ formatear_fecha($cotizacion->fecha_emision) }}</td>
                                    <td>{{ formatear_fecha($cotizacion->fecha_vencimiento) }}</td>
                                    <td>{{ $cotizacion->nombre_usuario }}</td>
                                    <td>
                                        {{ Form::open(['url' => route('trabajo.costo.cotizacion.destroy', [$trabajo->id, $cotizacion->id_costo, $cotizacion->id]), 'onsubmit' => "return confirm('¿Seguro que deseas eliminar el archivo? Esta acción es IRREVERSIBLE!');"]) }}
                                        <a href="{{ route('trabajo.costo.cotizacion.show', [$trabajo->id, $cotizacion->id_costo, $cotizacion->id]) }}" role="button" class="btn btn-default btn-sm">Detalles</a>&nbsp;
                                        <a href="{{ url('generar_pdf/'.$cotizacion->id) }}" role="button" class="btn btn-default btn-sm"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                        @if(Auth::id() == 1)
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                        @endif
                                        {{ method_field('DELETE') }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td><i>No se encontraron cotizaciones generadas para este trabajo</i>.</td>
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                        @endif
                    </tbody>
                </table><br>

            </div>
        </div>

        <div class="row peacon-block">
            <div class="col-sm-12">
                <h1>Pagos registrados</h1>
                <table class="work_list table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Medio de pago</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($pagos) > 0)
                        @foreach($pagos as $pago)
                            <tr>
                                <td>{{ $pago->monto }}</td>
                                <td>{{ formatear_fecha($pago->fecha) }}</td>
                                <td>{{ $pago->medio_pago }}</td>
                                <td>
                                    {{ Form::open(['url' => '/trabajo/'.$trabajo->id.'/pago/'.$pago->id, 'onsubmit' => "return confirm('¿Seguro que deseas ELIMINAR el pago seleccionado? Esta acción es irreversible!');"]) }}
                                    <a href="{{url('trabajo/'.$trabajo->id.'/pago/'.$pago->id.'/edit')}}" role="button" class="btn btn-default btn-sm"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                    @if(Auth::id() == 1)
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                    @endif
                                    {{ method_field('DELETE') }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td><i>No se encontraron pagos realizados para este trabajo</i>.</td>
                            <td></td><td></td><td></td>
                        </tr>
                    @endif
                    </tbody>
                </table><br>
                <a href="{{url('trabajo/'.$trabajo->id.'/pago/create')}}" role="button" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Pago</a>
            </div>
        </div>

        <div class="row peacon-block documentos">
            <div class="col-sm-12">
                <h1>Documentos subidos </h1>
                <table class="work_list table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Archivo</th>
                        <th>Tamaño</th>
                        <th>Fecha emisión</th>
                        <th>Comentario</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($documentos) > 0)
                        @foreach($documentos as $documento)
                            <tr>
                                <td>{{ $documento->titulo }}</td>
                                <td class="colored-anchor"><a href="{{ url('trabajo/'.$trabajo->id.'/documento/'.$documento->id.'/download') }}">{{ formatear_archivo($documento->archivo) }}</a></td>
                                <td>{{ formatear_bytes($documento->peso) }}</td>
                                <td>{{ formatear_fecha ($documento->fecha_emision) }}</td>
                                <td>{{ $documento->comentario }}</td>
                                <td>
                                    {{ Form::open(['url' => '/trabajo/'.$trabajo->id.'/documento/'.$documento->id, 'onsubmit' => "return confirm('¿Seguro que deseas eliminar el archivo? Esta acción es IRREVERSIBLE!');"]) }}
                                    <a href="{{url('trabajo/'.$trabajo->id.'/documento/'.$documento->id)}}" role="button" class="btn btn-default btn-sm">Detalles</a>&nbsp;
                                    <a href="{{ url('trabajo/'.$trabajo->id.'/documento/'.$documento->id.'/download') }}" role="button" class="btn btn-sm btn-default"><i class="fa fa-download fa-lg" aria-hidden="true"></i></a>&nbsp;
                                    @if(Auth::id() == 1)
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                    @endif
                                    {{ method_field('DELETE') }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td><i>No se encontraron documentos para este trabajo</i>.</td>
                            <td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    @endif
                    </tbody>
                </table><br>

                <a href="{{url('trabajo/'.$trabajo->id.'/documento/create')}}" role="button" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Documento</a>
            </div>
        </div>
    </div>
@endsection
