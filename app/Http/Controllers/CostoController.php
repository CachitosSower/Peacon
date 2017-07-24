<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Item;
use Illuminate\Support\Facades\Redirect;
use app\http\requests\CostoFormRequest;
use DB;
class CostoController extends Controller
{
    public function _construct(){

    }
    public function index_cost2(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $item=DB::table('item')->where('item','LIKE','%'.$query.'%')
                ->paginate(7);
            return view('work.new', ["item"=>$item,"searchText"=>$query]);
        }
    }

    public function create(){
        return view('work.new');
    }
    public function store(CostoFormRequest $request){
        $item=new Item;
        $item->item=$request->get("item");
        $item->cantidad=$request->get("cantidad");
        $item->precio=$request->get("precio");
        $item->descuento_bruto=$request->get("descuento_bruto");
        $item->descuento_porcentual=$request->get("descuento_porcentual");
        $item->parcial=$request->get("parcial");
        $item->iva=$request->get("iva");
        $item->total=$request->get("total");
        $item->save();
        return Redirect::to('work.new');
    }
    public function show($id){
        return view("work.new.show",["item"=>Item::findOrFail($id)]);
    }
    public function edit($id){
        return view("work.new.edit",["item"=>Item::findOrFail($id)]);
    }

    public function update(CostoFormRequest $request, $id){
        $item=Item::findOrFail($id);
        $item->item=$request->get('item');
        $item->cantidad=$request->get("cantidad");
        $item->precio=$request->get("precio");
        $item->descuento_bruto=$request->get("descuento_bruto");
        $item->descuento_porcentual=$request->get("descuento_porcentual");
        $item->parcial=$request->get("parcial");
        $item->iva=$request->get("iva");
        $item->total=$request->get("total");
        $item->update();
        return Redirect::to('work.new');



    }

    public function destroy($id){
        $item=Item::findOrFail($id);
        $item->id='0';
        $item->update();
        return Redirect::to('work.new');
    }

}

