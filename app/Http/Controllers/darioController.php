<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class darioController extends Controller
public function (ingresarUF){
    return view('ingresarUF');
}
public function create ($uf){
    return view ('producto') with ('uf'),
        $uf);
}

    public function store (request::$request);
    {
        $producto = new producto($request
        all());

        $producto=> precio_uf: $producto
        precio_clp :$request::valor_uf;
        $producto=>save();
        }
}


    //
}
