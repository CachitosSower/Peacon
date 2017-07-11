@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Nueva definición de costos</h1>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h3>Costos añadidos</h3>
                <br>
                <table class="table-striped">
                    <thead>
                    <tr>
                        <th>ITEM</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO</th>
                        <th>COBRO</th>
                        <th>DESC %</th>
                        <th>DESC</th>
                        <th>PARCIAL</th>
                        <th>IVA</th>
                        <th>TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <?php $cost = $item->price * 1.2; ?>
                        <?php $partial = ($cost * $item->amount) * ((100 - $item->discount_percent)/100) - $item->discount; ?>
                        <?php $iva = $partial * 0.19; ?>
                        <tr>
                            <td>{{$item->item}}</td>
                            <td>{{ $item->amount }}</td>
                            <td>$ {{ number_format($item->price, 0, ",", ".") }}</td>
                            <td>$ {{ number_format($cost * 1.2, 0, ",", ".")  }}</td>
                            <td>{{$item->discount_percent}}%</td>
                            <td>$ {{ number_format($item->discount, 0, ",", ".") }}</td>
                            <td>$ {{ number_format($partial , 0, ",", ".") }}</td>
                            <td>$ {{ number_format($iva , 0, ",", ".") }}</td>
                            <td><strong>$ {{ number_format($partial + $iva , 0, ",", ".") }}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <br>
                <h3>Agregar nueva entrada de costos</h3>
                <br>
                <form>
                    <div class="form-group">
                        <label for="item">Item</label>
                        <input type="text" class="form-control" id="item" placeholder="Item">
                    </div>
                    <div class="form-group">
                        <label for="amount">Cantidad</label>
                        <input type="text" class="form-control" id="amount" placeholder="N°">
                    </div>
                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="text" class="form-control" id="price">
                    </div>
                    <div class="form-group">
                        <label for="discount_percent">Descuento porcentual</label>
                        <input type="text" class="form-control" id="discount_percent">
                    </div>
                    <div class="form-group">
                        <label for="discount">Descuento bruto</label>
                        <input type="text" class="form-control" id="discount">
                    </div>


                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Corresponde a un proveedor
                        </label>
                    </div>
                    <button type="button" class="btn btn-success">Añadir</button>
                </form>


                <br><br><br>
            </div>
        </div>
    </div>
@endsection
