<?php

namespace App\Http\Controllers;

use App\Costo;
use App\Item;
use Illuminate\Http\Request;

class CotizacionController extends Controller
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
     * @param   int $id_trabajo
     * @param   int $id_costo
     * @return \Illuminate\Http\Response
     */
    public function create($id_trabajo, $id_costo)
    {
        $costo = Costo::find($id_costo);

        $neto = 0;
        $iva = 0;
        $desc = 0;
        $itemes = Item::where('id_costo', $id_costo)->get();
        foreach ($itemes as $item) {
            $item->costo = $item->precio;
            $item->precio = (int) ($item->costo * ($item->es_proveedor ? 1 : 1.2));
            $item->total =
                (int)(($item->precio * $item->cantidad)
                    * ($item->descuento_porcentual ? (100 - $item->descuento_porcentual) / 100 : 1)
                    - ($item->descuento_bruto ? $item->descuento_bruto : 0));
            $neto += $item->total;
            $item->iva = (int) ($item->total * 0.19);
            $iva += $item->iva;
            $item->bruto = $item->total + $item->iva;
        }
        return view('cotizacion.create', [
            'id_trabajo'    => $id_trabajo,
            'costo'         => $costo,
            'itemes'        => $itemes,
            'neto'          => $neto,
            'iva'           => $iva,
            'desc'          => $desc,
            'total'         => ($neto + $iva - $desc),
        ]);
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
        //
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
}
