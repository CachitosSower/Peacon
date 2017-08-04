<?php

namespace App\Http\Controllers;

use App\Costo;
use App\Cotizacion;
use App\Documento;
use App\Http\Requests\StoreTrabajoRequest;
use App\Item;
use App\Pago;
use App\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @param  \App\Http\Requests\StoreTrabajoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrabajoRequest $request)
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
        /* TRABAJOS */
        $trabajo = Trabajo::find($id);
        $trabajo->descripcion = ucfirst($trabajo->descripcion);
        $trabajo->rut = formatear_rut($trabajo->rut);

        /* PAGOS */
        $pagos = Pago::where('id_trabajo', '=', $id)->get();
        $pagos = PagoController::preprocess($pagos);

        /* COSTOS */
        //$costos = Costo::where('id_trabajo', $id)->get();
        $costos = DB::table('costos')
            ->where('costos.id_trabajo', $id)
            ->leftJoin('cotizaciones', 'costos.id', '=', 'cotizaciones.id_costo')
            ->select('costos.*', 'cotizaciones.id as id_cotizacion')
            ->orderby('costos.created_at', 'desc')
            ->get();
        /* DOCUMENTOS */
        $documentos = Documento::where('id_trabajo', '=', $id)->get();

        /* COTIZACIONES */
        $cotizaciones = DB::table('cotizaciones')
            ->where('cotizaciones.id_trabajo', $id)
            ->join('costos', 'cotizaciones.id_costo', '=', 'costos.id')
            ->join('users', 'users.id', '=', 'cotizaciones.id_user')
            ->select('cotizaciones.*', 'costos.id as id_costo', 'costos.descripcion as descripcion_costo', 'users.name as nombre_usuario')
            ->orderby('cotizaciones.created_at', 'desc')
            ->get();


        return view('trabajo.show', [
            'trabajo'       => $this->preprocess($trabajo),
            'pagos'         => $pagos,
            'documentos'    => $documentos,
            'cotizaciones'    => $cotizaciones,
            'costos'        => $this->agregar_totales($costos),
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
     * @param  \App\Http\Requests\StoreTrabajoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTrabajoRequest $request, $id)
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

    private function agregar_totales ($costos)
    {
        foreach ($costos as $costo) {
            $total = 0;
            $itemes = Item::where('id_costo', $costo->id)->get();
            foreach ($itemes as $item) {
                $item->precio = (int) ($item->precio * ($item->es_proveedor ? 1 : 1.2));
                $item->total +=
                    (int)(($item->precio * $item->cantidad)
                        * ($item->descuento_porcentual ? (100 - $item->descuento_porcentual) / 100 : 1)
                        - ($item->descuento_bruto ? $item->descuento_bruto : 0));
                $iva = (int) ($item->total * 0.19);
                $total += $item->total + $iva;
            }
            $costo->total = $total;
        }
        return $costos;
    }

    private function preprocess($work)
    {
        switch ($work->estado) {
            case -1:
                $work->estado_string = '<strong style="color:gray">Desechado</strong>. Fue iniciado el <strong>' . formatear_fecha($work->fecha_inicio) . '</strong>';
                $work->iniciado = true;
                $work->terminado = true;
                break;
            case 0:
                $work->estado_string = '<strong style="color:darkgray">Inactivo</strong>';
                $work->iniciado = false;
                $work->terminado = false;
                break;
            case 1:
                $work->estado_string = '<strong style="color:#ed6448">Activo</strong> desde el  <strong>' . formatear_fecha($work->fecha_inicio) . '</strong>';
                $work->iniciado = true;
                $work->terminado = false;
                break;
            case 2:
                $work->estado_string = '<strong style="color:green">Finalizado</strong>. Fue iniciado el  <strong>' . formatear_fecha($work->fecha_inicio) . '</strong>';
                $work->iniciado = true;
                $work->terminado = true;
                break;
        }
        return $work;
    }
}
