<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeaRequest;
use App\Wea;
use Illuminate\Http\Request;

class WeaController extends Controller
{
    public function create($uf)
    {
        return view('wea.index', ['uf' => $uf]);
    }

    public function store (WeaRequest $request)
    {
        $wea = new Wea();
        $wea->item = $request->item;
        $wea->precio_clp = $request->precio_clp;
        $wea->precio_uf = $request->precio_clp / $request->uf;
        $wea->save();
        return redirect('zxasqw/'.$request->uf)->with('status', '¡Agregado con etsito!!!');
    }
}
