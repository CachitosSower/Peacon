
            <div class="row peacon-block">
                <div class="col-sm-12">
                    <h1>Definiciones de costos</h1>
                    <table class="table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Fecha creación</th>
                            <th>Total</th>
                            <th style="text-align:center">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($costos) > 0)
                            @foreach($costos as $costo)
                                <tr>
                                    <td>{{ $costo->descripcion }}</td>
                                    <td>{{ formatear_fecha($costo->created_at) }}</td>
                                    <td>{{ formatear_dinero($costo->total) }}</td>
                                    <td style="text-align:center">
                                        {{ Form::open(['url' => '/trabajo/'.$trabajo->id.'/costo/'.$costo->id, 'onsubmit' => "return confirm('¿Seguro que deseas ELIMINAR la definición de costos? Esta acción es irreversible!');"]) }}
                                        <a href="{{url('/trabajo/'.$costo->id_trabajo.'/costo/'.$costo->id)}}" role="button" class="btn btn-default btn-sm">Detalles</a>
                                        <a href="{{url('/trabajo/'.$costo->id_trabajo.'/costo/'.$costo->id.'/cotizacion/create')}}" role="button" class="btn btn-primary btn-sm">Cotizar</a>
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                        {{ method_field('DELETE') }}
                                        {{ Form::close() }}
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td><i>No se encontraron costos definidos para este trabajo</i>.</td>
                                <td></td><td></td><td></td>
                            </tr>
                        @endif
                        </tbody>
                    </table><br>
                    <a href="{{ url('trabajo/'.$trabajo->id.'/costo/create') }}" role="button" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Costo</a>
                </div>
            </div>
