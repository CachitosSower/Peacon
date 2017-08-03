<?php

namespace App\Http\Controllers;

use App\Costo;
use App\Documento;
use App\Pago;
use App\Trabajo;
use Illuminate\Http\Request;

class TrabajoController extends Controller
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
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trabajo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trabajo = new Trabajo();
        $trabajo->descripcion = $request->descripcion;
        $trabajo->empresa = $request->empresa;
        $rut = preg_replace('/[^k0-9]/i', '', $request->rut);
        $trabajo->rut = substr($rut, 0, strlen($rut)-1);
        if (!empty($request->activar) && $request->activar == 1) {
            $trabajo->estado = 1;
            $fecha = new \DateTime();
            $trabajo->fecha_inicio = $fecha->format('Y-m-d H:i:s');
        } else {
            $trabajo->estado = 0;
        }
        $trabajo->save();
        return redirect('/')->with('status', '¡Trabajo creado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trabajo = Trabajo::find($id);
        $trabajo->descripcion = ucfirst($trabajo->descripcion);
        $trabajo->rut = formatear_rut($trabajo->rut);
        $date = explode('-', substr($trabajo->fecha_inicio, 0, stripos($trabajo->fecha_inicio, ' ')));
        $trabajo->fecha_inicio = $date[2].'-'.$date[1].'-'.$date[0];

        $pagos = Pago::where('id_trabajo', '=', $id)->get();
        $pagos = PagoController::preprocess($pagos);

        $costos = Costo::where('id_trabajo', $id)->get();

        $documentos = Documento::where('id_trabajo', '=', $id)->get();


        return view('trabajo.show', [
            'trabajo'       => $this->preprocess($trabajo),
            'pagos'         => $pagos,
            'documentos'    => $documentos,
            'costos'        => $costos
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
        $trabajo = Trabajo::find($id);
        $trabajo->rut = formatear_rut($trabajo->rut);
        return view('trabajo.edit', ['trabajo' => $trabajo]);
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
        $trabajo = Trabajo::find($id);
        $trabajo->descripcion = $request->descripcion;
        $trabajo->empresa = $request->empresa;
        $rut = preg_replace('/[^k0-9]/i', '', $request->rut);
        $trabajo->rut = substr($rut, 0, strlen($rut)-1);
        $trabajo->estado = $request->estado;
        $fecha = new \DateTime();
        if ($request->estado == 2 || $request->estado == -1) {
            $trabajo->fecha_termino = $fecha->format('Y-m-d H:i:s');
        } else if ($request->estado == 1) {
            $trabajo->fecha_inicio = $fecha->format('Y-m-d H:i:s');
        }
        $trabajo->save();
        return redirect('trabajo/'.$id)->with('status', '¡Trabajo modificado con éxito!');
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

    private function preprocess($work)
    {
        switch ($work->estado) {
            case -1:
                $work->estado_string = '<strong style="color:gray">Desechado</strong>. Fue iniciado el <strong>' . $work->fecha_inicio . '</strong>';
                $work->iniciado = true;
                $work->terminado = true;
                break;
            case 0:
                $work->estado_string = '<strong style="color:darkgray">Inactivo</strong>';
                $work->iniciado = false;
                $work->terminado = false;
                break;
            case 1:
                $work->estado_string = '<strong style="color:#ed6448">Activo</strong> desde el  <strong>' . $work->fecha_inicio . '</strong>';
                $work->iniciado = true;
                $work->terminado = false;
                break;
            case 2:
                $work->estado_string = '<strong style="color:green">Finalizado</strong>. Fue iniciado el  <strong>' . $work->fecha_inicio . '</strong>';
                $work->iniciado = true;
                $work->terminado = true;
                break;
        }
        return $work;
    }
}
