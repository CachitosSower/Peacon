@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Definición de costos <a href="item/create"><button class="btn btn-success">Nuevo</button></a></h3>
                @include('work.search')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table>
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <th>ITEM</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>COBRO</th>
                            <th>DESC %</th>
                            <th>DESC</th>
                            <th>PARCIAL</th>
                            <th>IVA</th>
                            <th>TOTAL</th>
                            </thead>
                         @foreach ($item as $itema)
                             <tr>
                             <td>{{$itema->item}}</td>
                             <td>{{$itema->cantidad}}</td>
                             <td>{{$itema->precio}}</td>
                             <td>{{$itema->cobro}}</td>
                             <td>{{$itema->descuento_bruto}}</td>
                             <td>{{$itema->descuento_porcentual}}</td>
                             <td>{{$itema->parcial}}</td>
                             <td>{{$itema->iva}}</td>
                             <td>{{$itema->total}}</td>
                                 <td>
                                     <a href=""> <button class="btn btn-info">Editar</button></a>
                                     <a href=""> <button class="btn btn-danger">Eliminar</button></a>
                                 </td>
                             </tr>
                             @endforeach
                        </table>
                    </table>

                </div>
                {{$item->render()}}
            </div>
        </div>

    </div>
@endsection
