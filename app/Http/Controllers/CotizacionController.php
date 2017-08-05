<?php

namespace App\Http\Controllers;

use App\Costo;
use App\Cotizacion;
use App\Http\Requests\StoreCotizacionRequest;
use App\Item;
use App\Pago;
use App\User;
use App\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @param  \App\Http\Requests\StoreCotizacionRequest  $request
     * @param   int $id_trabajo
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCotizacionRequest $request, $id_trabajo, $id_costo)
    {
        $cotizacion = new Cotizacion();
        $cotizacion->id_user = \Auth::id();
        $cotizacion->id_trabajo = $id_trabajo;
        $cotizacion->id_costo = $id_costo;
        $cotizacion->nombre = $request->nombre;
        $cotizacion->correo = $request->correo;
        $cotizacion->telefono = $request->telefono;
        $cotizacion->fecha_emision = $request->fecha_emision;
        $cotizacion->fecha_vencimiento = $request->fecha_vencimiento;
        $cotizacion->comentario = $request->comentario;
        $cotizacion->save();
        return redirect('trabajo/'.$id_trabajo)->with('status', '¡Cotización generada con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @param  int  $id_cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show($id_trabajo, $id_costo, $id_cotizacion)
    {
        $cotizacion = Cotizacion::find($id_cotizacion);
        $usuario = User::find($cotizacion->id_user);
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

        return view('cotizacion.show', [
            'cotizacion'    => $cotizacion,
            'costo'         => $costo,
            'usuario'       => $usuario,
            'id_trabajo'    => $id_trabajo,
            'id_costo'      => $id_costo,
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
     * @param  int  $id_cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id_trabajo, $id_costo, $id_cotizacion)
    {
        $cotizacion = Cotizacion::find($id_cotizacion);
        return view('cotizacion.edit', [
            'cotizacion'    => $cotizacion,
            'id_costo'      => $id_costo,
            'id_trabajo'    => $id_trabajo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCotizacionRequest  $request
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @param  int  $id_cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCotizacionRequest $request, $id_trabajo, $id_costo, $id_cotizacion)
    {
        $cotizacion = Cotizacion::find($id_cotizacion);
        $cotizacion->nombre = $request->nombre;
        $cotizacion->correo = $request->correo;
        $cotizacion->telefono = $request->telefono;
        $cotizacion->fecha_emision = $request->fecha_emision;
        $cotizacion->fecha_vencimiento = $request->fecha_vencimiento;
        $cotizacion->comentario = $request->comentario;
        $cotizacion->save();
        return redirect('trabajo/'.$id_trabajo.'/costo/'.$id_costo.'/cotizacion/'.$id_cotizacion)->with('status', '¡Cotización modificada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @param  int  $id_cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_trabajo, $id_costo, $id_cotizacion)
    {
        Cotizacion::destroy($id_cotizacion);
        return redirect(route('trabajo.show', [$id_trabajo]))->with('status', '¡Cotización  ha sido ELIMINADA con éxito!');
    }

    public function generar_pdf($id)
    {
        $cotizacion = Cotizacion::find($id);
        $usuario = User::find($cotizacion->id_user);
        $costo = Costo::find($cotizacion->id_costo);
        $trabajo = Trabajo::find($cotizacion->id_trabajo);

        $neto = 0;
        $iva = 0;
        $desc = 0;
        $itemes = Item::where('id_costo', $cotizacion->id_costo)->get();
        foreach ($itemes as $item) {
            $item->costo = $item->precio;
            $item->precio = (int) ($item->costo * ($item->es_proveedor ? 1 : 1.2));
            $item->total =
                (int)(($item->precio * $item->cantidad)
                    * ($item->descuento_porcentual ? (100 - $item->descuento_porcentual) / 100 : 1)
                    - ($item->descuento_bruto ? $item->descuento_bruto : 0));
            $item->descuento = ($item->precio * $item->cantidad) - $item->total;
            $neto += $item->total;
            $item->iva = (int) ($item->total * 0.19);
            $iva += $item->iva;
            $item->bruto = $item->total + $item->iva;
        }

        return view('pdf.cotizacion', [
            'cotizacion'    => $cotizacion,
            'costo'         => $costo,
            'usuario'       => $usuario,
            'trabajo'       => $trabajo,
            'itemes'        => $itemes,
            'neto'          => $neto,
            'iva'           => $iva,
            'desc'          => $desc,
            'total'         => ($neto + $iva - $desc),
        ]);
    }

}
