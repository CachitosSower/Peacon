<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .header {
            color: white;
            background-color: #ed6448;
            background-repeat: no-repeat;
            background-image: url({{ asset('images/logo_h100.png') }});
            background-position: center;
            height: 150px;
            margin-bottom: 100px;
        }
        .header .izquierda {
            float: left;
        }
        .header .izquierda h3 {
            margin: 0;
            position: relative;
            top: 57px;
            left: 100px;
            font-size: 18px;
        }
        .header .derecha h3 {
            margin: 0;
            position: relative;
            top: 57px;
            right: 100px;
            font-size: 18px;
            text-align: right;
        }
        .header .derecha {
            float: right;
        }
        .datos,
        .encargos,
        .notas {
            margin-bottom: 100px;
        }
        .nombre-campo h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            line-height: 30px;
            color: #333;
        }
        .campo {
            color: #333;
            background-color: #ccc;
            height: 30px;
            font-size: 18px;
            font-weight: 600;
            line-height: 30px;
        }
        .datos .row {
            margin-bottom: 5px;
        }
        .encargos h3 {
            margin: 0;
            font-size: 18px;
            line-height: 30px;
            color: #333;
            text-align: center;
        }
        .encargo {
            margin-bottom: 5px;
        }
        .encargos .head div,
        .encargos .totales div {
            margin-right: 5px;
        }
        .encargos .head h3 {
            font-weight: bold;
            font-size: 20px;
        }
        .encargo div {
            color: #333;
            height: 30px;
            font-size: 18px;
            font-weight: 600;
            line-height: 30px;
            margin-right: 5px;
            background-color: #ccc;
        }
        .totales div.campo {
            color: #333;
            height: 30px;
            font-size: 18px;
            font-weight: 600;
            line-height: 30px;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .totales div.campo h3 {
            font-weight: 600;
        }
        .notas h3 {
            margin: 0;
            font-size: 18px;
            line-height: 30px;
            color: #333;
            text-align: left;
            font-weight: 600;
        }
        .nota {
            height:120px;
            background-color: #ccc;
            color: #333;
        }
        .aprobado .contenedor {
            border-bottom: solid 3px #ed6448;
        }
        .aprobado h3 {
            margin: 0;
            font-size: 18px;
            line-height: 30px;
            color: #333;
            text-align: center;
            font-weight: 600;
        }
        .footer {
            color: white;
            background-color: #ed6448;
            background-repeat: no-repeat;
            background-position: center;
            margin-top: 60px;
            padding: 80px 0;
        }
    </style>
</head>

<body>

<div class="container-fluid">

    <div class="header row">
        <div class="izquierda">
            <h3>Fono +56 9 6396 2257</h3>
            <h3>Mail: ventas@ymir.cl</h3>
        </div>
        <div class="derecha">
            <h3>Folio cotizacion:</h3>
            <h3><strong>{{ formatear_folio($cotizacion->id, 5) }}</strong></h3>
        </div>
    </div>

    <div class="datos row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-3 nombre-campo"><h3>Señor/a</h3></div>
                    <div class="col-sm-8 campo">{{ $cotizacion->nombre }}</div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-2 col-sm-offset-1 nombre-campo"><h3>Mail</h3></div>
                    <div class="col-sm-8 campo">{{ $cotizacion->correo }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-3 nombre-campo"><h3>Empresa</h3></div>
                    <div class="col-sm-8 campo">{{ $trabajo->empresa }}</div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-2 col-sm-offset-1 nombre-campo"><h3>RUT</h3></div>
                    <div class="col-sm-8 campo">{{ $trabajo->rut }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-3 nombre-campo"><h3>Telefono</h3></div>
                    <div class="col-sm-8 campo">{{ $cotizacion->telefono }}</div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-2 col-sm-offset-1"></div>
                    <div class="col-sm-8"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-3 nombre-campo"><h3>Fecha</h3></div>
                    <div class="col-sm-8 campo">{{ formatear_fecha($cotizacion->fecha_emision) }}</div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-2 col-sm-offset-1 nombre-campo"><h3>Vence</h3></div>
                    <div class="col-sm-8 campo">{{ formatear_fecha($cotizacion->fecha_vencimiento) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row encargos">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row head">
                <div class="col-sm-4"><h3>ENCARGO</h3></div>
                <div class="col-sm-1"><h3>CANT.</h3></div>
                <div class="col-sm-2"><h3>PRECIO</h3></div>
                <div class="col-sm-2"><h3>DESCUENTO</h3></div>
                <div class="col-sm-2"><h3>TOTAL</h3></div>
            </div>
            <br>
            @foreach($itemes as $item)
            <div class="row encargo">
                <div class="col-sm-4"><h3>{{ $item->nombre }}</h3></div>
                <div class="col-sm-1"><h3>{{ $item->cantidad }}</h3></div>
                <div class="col-sm-2"><h3>{{ formatear_dinero($item->precio) }}</h3></div>
                <div class="col-sm-2"><h3>{{ formatear_dinero($item->descuento) }}</h3></div>
                <div class="col-sm-2"><h3>{{ formatear_dinero($item->total) }}</h3></div>
            </div>
            @endforeach

            <br>
            <div class="row totales">
                <div class="col-sm-4"><h3></h3></div>
                <div class="col-sm-1"><h3>.</h3></div>
                <div class="col-sm-2"><h3></h3></div>
                <div class="col-sm-2 campo"><h3>NETO</h3></div>
                <div class="col-sm-2 campo"><h3>{{ formatear_dinero($neto) }}</h3></div>
            </div>
            <div class="row totales">
                <div class="col-sm-4"><h3></h3></div>
                <div class="col-sm-1"><h3>.</h3></div>
                <div class="col-sm-2"><h3></h3></div>
                <div class="col-sm-2 campo"><h3>DESCUENTO</h3></div>
                <div class="col-sm-2 campo"><h3>-</h3></div>
            </div>
            <div class="row totales">
                <div class="col-sm-4"><h3></h3></div>
                <div class="col-sm-1"><h3>.</h3></div>
                <div class="col-sm-2"><h3></h3></div>
                <div class="col-sm-2 campo"><h3>IVA</h3></div>
                <div class="col-sm-2 campo"><h3>{{ formatear_dinero($iva) }}</h3></div>
            </div>
            <div class="row totales">
                <div class="col-sm-4"><h3></h3></div>
                <div class="col-sm-1"><h3>.</h3></div>
                <div class="col-sm-2"><h3></h3></div>
                <div class="col-sm-2 campo" style="background-color:#ed6448"><h3 style="color:white;">TOTAL</h3></div>
                <div class="col-sm-2 campo"><h3>{{ formatear_dinero($total) }}</h3></div>
            </div>

        </div>
    </div>

    <div class="row notas">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="col-sm-1"><h3>NOTAS</h3></div>
            <div class="col-sm-11 nota"><h3>{{ $cotizacion->comentario }}</h3></div>
        </div>
    </div>

    <div class="row aprobado">
        <div class="col-sm-4 col-sm-offset-7">
            <div class="col-sm-12 contenedor">
                <h3>Aprobado por: {{ $usuario->name }}</h3>
            </div>
        </div>
    </div>

    <div class="footer row">
        <div class="col-sm-5 col-sm-offset-1">
            <h3 style="font-weight: 600">DATOS PARA REALIZAR EL PAGO</h3>
            <ul class="list-unstyled">
                <li>Banco Estado</li>
                <li>Chequera electrónica N° 533-7-171580-7</li>
                <li>Diseno Grafico y Servicios Informaticos Ymir Limitada</li>
                <li>76.608.248-3</li>
                <li>ventas@ymir.cl</li>
            </ul>
        </div>
        <div class="col-sm-5">
            <h3 style="font-weight: 600">DATOS PARA GENERAR ORDEN DE COMPRA</h3>
            <ul class="list-unstyled">
                <li>Diseño Gráfico y Servicios Informáticos Ymir Limitada</li>
                <li>76.608.248-3</li>
                <li>Producción Gráfica, Branding Corporativo y Diseño Web</li>
                <li>General Gorostiaga 1490, Concepción</li>
            </ul>
        </div>
        <div class="col-sm-12" style="margin-top: 60px;">
            <h3 style="text-align:center;font-weight:600;">WWW.YMIR.CL</h3>
        </div>
    </div>

</div>

</body>

</html>
