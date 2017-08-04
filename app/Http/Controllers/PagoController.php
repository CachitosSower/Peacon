<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PagoController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_trabajo)
    {
        return view('pago.create',
            ['id_trabajo' => $id_trabajo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @param   int $id_trabajo
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request, $id_trabajo)
    {
        $pago = new Pago();
        $pago->id_trabajo=$id_trabajo;
        $pago->monto=$request->monto;
        $pago->medio_pago=$request->medio_pago;
        $pago->fecha=$request->fecha;
        $pago->save();
        return redirect('trabajo/'.$id_trabajo)->with('status', '¡Pago generado con éxito!');
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
     * @param  int  $id_trabajo
     * @param  int  $id_pago
     * @return \Illuminate\Http\Response
     */
    public function edit($id_trabajo, $id_pago)
    {
        $pago = Pago::find($id_pago);
        return view('pago.edit', [
            'pago' => $pago,
            'id_trabajo' => $id_trabajo
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @param  int  $id_trabajo
     * @param  int  $id_pago
     * @return \Illuminate\Http\Response
     */
    public function update(StorePagoRequest $request, $id_trabajo, $id_pago)
    {
        $pago = Pago::find($id_pago);
        $pago->monto=$request->monto;
        $pago->medio_pago=$request->medio_pago;
        $pago->fecha=$request->fecha;
        $pago->save();
        return redirect('trabajo/'.$id_trabajo)->with('status', '¡Pago editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_pago
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_trabajo, $id_pago)
    {
        Pago::destroy($id_pago);
        return redirect('trabajo/'.$id_trabajo)->with('status', '¡El Pago ha sido ELIMINADO con éxito!');
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
