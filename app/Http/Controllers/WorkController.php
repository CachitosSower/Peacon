<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewWork;
use Illuminate\Http\Request;
use App\Work;

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
        $work->rut = $work->rut . '-' . $this->calc_dv($work->rut);
        return view('work.details', ['work' => $this->preprocess($work)]);
    }

    public function create()
    {
        return view('work.create');
    }

    public function edit($id)
    {
        $work = Work::find($id);
        return view('work.edit', ['work' => $work]);
    }

    public function store(StoreNewWork $request)
    {
        $work = new Work();
        $work->descripcion = $request->descripcion;
        $work->empresa = $request->empresa;
        $work->rut = $request->rut;
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
        $work->empresa = $request->empresa;
        $work->rut = $request->rut;
        $work->estado = $request->estado;
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
        return view('work.new', ['items' => $this->falseData()]);
    }

    public function ucall($str)
    {
        return preg_replace_callback('/(\w+)(?!=[.?!])/', function($m){
            return ucwords($m[0]);
        }, $str);
    }

    public function calc_dv($rut)
    {
        while($rut[0] == "0") {
            $rut = substr($rut, 1);
        }
        $factor = 2;
        $suma = 0;
        for($i = strlen($rut) - 1; $i >= 0; $i--) {
            $suma += $factor * $rut[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $dv = 11 - $suma % 11;
        $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
        return $dv;
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

    private function falseData()
    {
        $data = [];

        $data1 = new \stdClass();
        $data1->item = "Servicio 1";
        $data1->amount = 2;
        $data1->price = 30000;
        $data1->discount_percent = 0;
        $data1->discount = 0;
        $data1->provider = false;
        array_push($data, $data1);

        $data1 = new \stdClass();
        $data1->item = "Proveedores servicio 1";
        $data1->amount = 3;
        $data1->price = 10000;
        $data1->discount_percent = 0;
        $data1->discount = 0;
        $data1->provider = true;
        array_push($data, $data1);

        $data1 = new \stdClass();
        $data1->item = "Servicio 2 con descuento 10%";
        $data1->amount = 5;
        $data1->price = 25000;
        $data1->discount_percent = 10;
        $data1->discount = 0;
        $data1->provider = false;
        array_push($data, $data1);

        return $data;
    }

}
