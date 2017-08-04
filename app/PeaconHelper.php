<?php

/*
|--------------------------------------------------------------------------
| Peacon Helpers
|--------------------------------------------------------------------------
|
| En esta clase se definen los métodos auxiliares que se utilizarán a lo
| largo del proyecto, y que son necesarios para su funcionamiento. Debiesen
| ser principalmente métodos para la transformación de la información a
| formatos utilizados localmente (Chile o en este proyecto en particular).
|
*/

/**
 * Da formato a un string de fecha desde la base de datos. Las fechas se almacena de
 * la forma 'Y m d' (Año més día), luego son transformadas al formato 'd de m de Y'
 * (por ejemplo, '2017-08-01' es convertido a '01 de octubre de 2017'
 *
 * @param   string  $fecha
 * @return  string
 */
function formatear_fecha ($fecha)
{
    if (stripos($fecha, ' ')) $fecha = explode(' ', $fecha)[0];
    $fecha_array = explode('-', $fecha);
    return $fecha_array[2] . ' de ' . obtener_mes_string($fecha_array[1]) . ' de ' . $fecha_array[0];
}


/**
 * Obtiene el nombre del mes que corresponde al número de mes ingresado.
 *
 * @param   integer     $mes_numero
 * @return  null|string
 */
function obtener_mes_string ($mes_numero)
{
    switch ($mes_numero) {
        case 1: return 'enero';
        case 2: return 'febrero';
        case 3: return 'marzo';
        case 4: return 'abril';
        case 5: return 'mayo';
        case 6: return 'junio';
        case 7: return 'julio';
        case 8: return 'agosto';
        case 9: return 'septiembre';
        case 10: return 'octubre';
        case 11: return 'noviembre';
        case 12: return 'diciembre';
    }
    return null;
}


/**
 * Calcula el dígito verificador para un número de RUT.
 *
 * @param   string  $numero
 * @return  int|string
 */
function calcular_dv($numero)
{
    $i = 2;
    $suma = 0;
    foreach(array_reverse(str_split($numero)) as $v)
    {
        if($i==8)
            $i = 2;
        $suma += $v * $i;
        ++$i;
    }
    $dvr = 11 - ($suma % 11);
    if($dvr == 11) $dvr = 0;
    if($dvr == 10) $dvr = 'K';
    return $dvr;
}


/**
 * Da formato a un rut, desde su forma numérica.
 * Por ejemplo: '123456789' se convierte en '12.345.678-9'
 *
 * @param   string  $number
 * @return  string
 */
function formatear_rut ($number) {
    return strrev(join('.', str_split(strrev($number), 3))) . '-' . calcular_dv($number);
}


/**
 * Determina el string adecuado para representar un conjunto de bytes. Utilizado para
 * mostrar tamaños de archivo de una manera fácil de leer.
 * Por ejemplo: '123456789' se convierte en '123 MB'
 *
 * @param   int $size
 * @param   int $precision
 * @return  string
 */
function formatear_bytes($size, $precision = 2) {
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}


/**
 * Da formato a un rut, desde su forma numérica.
 * Por ejemplo: '123456789' se convierte en '12.345.678-9'
 *
 * @param   string  $number
 * @return  string
 */
function formatear_dinero ($number) {
    return '$ ' . strrev(join('.', str_split(strrev($number), 3)));
}

function formatear_archivo ($archivo)
{
    $MAXIMO_TAMANO_ARCHIVO = 30;
    $archivo_real = substr($archivo, stripos($archivo, '_') + 1);
    if (strlen($archivo_real) > $MAXIMO_TAMANO_ARCHIVO) {
        $left = substr($archivo_real, 0, (int) ($MAXIMO_TAMANO_ARCHIVO / 2));
        $right = substr($archivo_real, strlen($archivo_real) - (int) ($MAXIMO_TAMANO_ARCHIVO / 2) + 3);
        return $left . '...' . $right;
    }
    return $archivo_real;
}