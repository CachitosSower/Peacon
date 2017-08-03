<?php

namespace App\Http\Controllers;

use App\Trabajo;
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
        $trabajos = Trabajo::orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $filtro_estado = 99;
        return view('home', ['trabajos' => $this->preprocess($trabajos), 'filtro_estado' => $filtro_estado]);
    }

    public function filter(Request $request)
    {
        if ($request->filtro_estado == 99) $trabajos = Trabajo::orderBy('created_at', 'desc');
        else $trabajos = Trabajo::where('estado', $request->filtro_estado)->orderBy('empresa', 'desc');
        $trabajos = $trabajos->take($request->filtro_cantidad)->get();
        return view('home', ['trabajos' => $this->preprocess($trabajos), 'filtro_estado' => $request->filtro_estado]);
    }

    private function preprocess($trabajos)
    {
        $trabajos_filtrados = [];
        foreach($trabajos as $trabajo) {
            switch ($trabajo->estado) {
                case -1: $trabajo->estado = '<strong style="color:gray">Desechado</strong>'; break;
                case 0: $trabajo->estado = '<strong style="color:darkgray">Inactivo</strong>'; break;
                case 1: $trabajo->estado = '<strong style="color:darkorange">Activo</strong>'; break;
                case 2: $trabajo->estado = '<strong style="color:green">Finalizado</strong>'; break;
            }
            array_push($trabajos_filtrados, $trabajo);
        }
        return $trabajos_filtrados;
    }
}
