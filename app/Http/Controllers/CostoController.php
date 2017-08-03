<?php

namespace App\Http\Controllers;

use App\Costo;
use App\Http\Requests\StoreCostoRequest;
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
     * @param   int $id_trabajo
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
     * @param   int $id_trabajo
     * @return \Illuminate\Http\Response
     */
    public function create($id_trabajo)
    {
        return view('costo.create', [
            'id_trabajo'    => $id_trabajo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCostoRequest  $request
     * @param   int $id_trabajo
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCostoRequest $request, $id_trabajo)
    {
        $costo = new Costo();
        $costo->descripcion = $request->descripcion;
        $costo->id_trabajo = $id_trabajo;
        $costo->save();
        return redirect('trabajo/'.$id_trabajo)->with('status', '¡Se ha agregado una nueva definición de costos con éxito!');
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
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @return \Illuminate\Http\Response
     */
    public function edit($id_trabajo, $id_costo)
    {
        $costo = Costo::find($id_costo);
        return view('costo.edit', [
            'id_trabajo'    => $id_trabajo,
            'costo'         => $costo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCostoRequest  $request
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCostoRequest $request, $id_trabajo, $id_costo)
    {
        $costo = Costo::find($id_costo);
        $costo->descripcion = $request->descripcion;
        $costo->save();
        return redirect('trabajo/'.$id_trabajo)->with('status', '¡Se modificó la definición de costos con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_trabajo, $id_costo)
    {
        Costo::destroy($id_costo);
        return redirect('trabajo/'.$id_trabajo)->with('status', '¡Costo ha sido ELIMINADO con éxito!');
    }
}
