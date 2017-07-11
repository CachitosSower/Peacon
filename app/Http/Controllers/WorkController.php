<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;

class WorkController extends Controller
{
    public function show_list()
    {
        $works = Work::all();
        return view('work.list', ['works' => $works]);
    }

    public function new_cost()
    {
        return view('work.new', ['items' => $this->falseData()]);
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
