<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
