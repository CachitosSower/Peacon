<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagoController extends Controller
{




    public static function preprocess($pagos)
    {
        foreach($pagos as $pago) {
            $pago->monto = self::format_dinero($pago->monto);
            switch ($pago->medio_pago) {
                case 1:
                    $pago->medio_pago = 'Efectivo';
                    break;
                case 2:
                    $pago->medio_pago = 'Cheque';
                    break;
                case 3:
                    $pago->medio_pago = 'Débito';
                    break;
                case 4:
                    $pago->medio_pago = 'Transferencia';
                    break;
            }
        }
        return $pagos;
    }

    private static function format_dinero ($number) {
        return '$ ' . strrev(join('.', str_split(strrev($number), 3)));
    }

}
