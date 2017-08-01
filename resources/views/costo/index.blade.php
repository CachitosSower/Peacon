
            <div class="row peacon-block">
                <div class="col-sm-12">
                    <h1>Definiciones de costos <a href="{{ url('trabajo/'.$trabajo->id.'/costo/create') }}" role="button" class="btn btn-success pull-right">Ingresar nueva</a></h1>
                    <table class="table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID TRABAJO</th>
                            <th>DESCRIPCION</th>
                            <th>Fecha creación</th>
                            <th style="text-align:center">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($costos as $costo)
                            <tr>
                                <td>{{ $costo->id }}</td>
                                <td>{{ $costo->id_trabajo }}</td>
                                <td>{{ $costo->descripcion }}</td>
                                <td>{{ $costo->created_at }}</td>
                                <td style="text-align:center"><a href="{{url('/trabajo/'.$costo->id_trabajo.'/costo/'.$costo->id)}}" role="button" class="btn btn-default btn-sm">Detalles</a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
