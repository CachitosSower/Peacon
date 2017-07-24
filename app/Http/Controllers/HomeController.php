<?php

namespace App\Http\Controllers;

use App\Work;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Work::orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $filtro_estado = 99;
        return view('home', ['works' => $this->preprocess($works), 'filtro_estado' => $filtro_estado]);
    }

    public function filter(Request $request)
    {
        if ($request->filtro_estado == 99) $works = Work::orderBy('created_at', 'desc');
        else $works = Work::where('estado', $request->filtro_estado)->orderBy('empresa', 'desc');
        $works = $works->take($request->filtro_cantidad)->get();
        return view('home', ['works' => $this->preprocess($works), 'filtro_estado' => $request->filtro_estado]);
    }

    private function preprocess($works)
    {
        $filtered_works = [];
        foreach($works as $work) {
            switch ($work->estado) {
                case -1: $work->estado = '<strong style="color:gray">Desechado</strong>'; break;
                case 0: $work->estado = '<strong style="color:darkgray">Inactivo</strong>'; break;
                case 1: $work->estado = '<strong style="color:darkorange">Activo</strong>'; break;
                case 2: $work->estado = '<strong style="color:green">Finalizado</strong>'; break;
            }
            array_push($filtered_works, $work);
        }
        return $filtered_works;
    }
}
