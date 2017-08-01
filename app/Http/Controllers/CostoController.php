<?php

namespace App\Http\Controllers;

use App\Costo;
use App\Item;
use Illuminate\Http\Request;

class CostoController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_trabajo)
    {
        $costos = Costo::where('id_trabajo', $id_trabajo)->get();
        return view('costo.index', [
            'costos'        => $costos,
            'id_trabajo'    => $id_trabajo,
        ]);
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
    public function show($id_trabajo, $id_costo)
    {
        $neto = 0;
        $iva = 0;
        $desc = 0;
        $costo = Costo::find($id_costo);
        $itemes = Item::where('id_costo', $id_costo)->orderBy('created_at', 'desc')->get();
        //dd($id);
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
        return view('costo.show', [
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
