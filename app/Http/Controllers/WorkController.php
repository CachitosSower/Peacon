<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewWork;
use Illuminate\Http\Request;
use App\Work;
use Illuminate\Support\Facades\Redirect;
use app\http\requests\CostoFormRequest;
use DB;

class WorkController extends Controller
{

    public function index($id)
    {
        $work = Work::find($id);
        $work->descripcion = $this->ucall($work->descripcion);
        $work->rut = $work->rut . '-' . $this->calc_dv($work->rut);
        return view('work.details', ['work' => $work]);
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
        $work->save();
        return redirect('trabajo/nuevo')->with('status', '¡Trabajo creado con éxito!');
    }

    public function update(StoreNewWork $request)
    {
        $work = Work::find($request->id);
        $work->descripcion = $request->descripcion;
        $work->empresa = $request->empresa;
        $work->rut = $request->rut;
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



}
