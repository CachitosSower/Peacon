<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewWork;
use App\Pago;
use App\Documento;
use Illuminate\Http\Request;
use App\Work;
use Illuminate\Support\Facades\Redirect;
use app\http\requests\CostoFormRequest;
use DB;

class WorkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $work = Work::find($id);
        $work->descripcion = $this->ucall($work->descripcion);
        $work->rut = $this->format_rut($work->rut);
        $date = explode('-', substr($work->fecha_inicio, 0, stripos($work->fecha_inicio, ' ')));
        $work->fecha_inicio = $date[2].'-'.$date[1].'-'.$date[0];

        $pagos = Pago::where('id_trabajo', '=', $id)->get();
        $pagos = PagoController::preprocess($pagos);

        $documentos = Documento::where('id_trabajo', '=', $id)->get();


        return view('work.details', ['work' => $this->preprocess($work), 'pagos' => $pagos, 'documentos' => $documentos]);
    }

    public function create()
    {
        return view('work.create');
    }

    public function edit($id)
    {
        $work = Work::find($id);
        $work->rut = $this->format_rut($work->rut);
        return view('work.edit', ['work' => $work]);
    }

    public function store(StoreNewWork $request)
    {
        $work = new Work();
        $work->descripcion = $request->descripcion;
        $work->empresa = $request->empresa;
        $rut = preg_replace('/[^k0-9]/i', '', $request->rut);
        $work->rut = substr($rut, 0, strlen($rut)-1);
        if (!empty($request->activar) && $request->activar == 1) {
            $work->estado = 1;
            $fecha = new \DateTime();
            $work->fecha_inicio = $fecha->format('Y-m-d H:i:s');
        } else {
            $work->estado = 0;
        }
        $work->save();
        return redirect('trabajos')->with('status', '¡Trabajo creado con éxito!');
    }

    public function update(StoreNewWork $request)
    {
        $work = Work::find($request->id);
        $work->descripcion = $request->descripcion;
        //$work->empresa = $request->empresa;
        $rut = preg_replace('/[^k0-9]/i', '', $request->rut);
        $work->rut = substr($rut, 0, strlen($rut)-1);
        //$work->estado = $request->estado;
        $fecha = new \DateTime();
        if ($request->estado == 2 || $request->estado == -1) {
            $work->fecha_termino = $fecha->format('Y-m-d H:i:s');
        } else if ($request->estado == 1) {
            $work->fecha_inicio = $fecha->format('Y-m-d H:i:s');
        }
        $work->save();
        return redirect('trabajo/'.$request->id)->with('status', '¡Trabajo modificado con éxito!');
    }



    public function show_list()
    {
        //$works = Work::all();
        //return view('work.list', ['works' => $works]);
    }

    public function new_cost()
    {
        return view('work.new');
    }

    public function ucall($str)
    {
        return preg_replace_callback('/(\w+)(?!=[.?!])/', function($m){
            return ucwords($m[0]);
        }, $str);
    }

    private function calc_dv($numero)
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

    private function format_rut ($number) {
        return strrev(join('.', str_split(strrev($number), 3))) . '-' . $this->calc_dv($number);
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
