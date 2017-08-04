<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
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
    public function index($id_costo)
    {
        $itemes = Item::where('id_costo', $id_costo)->get();
        return view('item.index', ['id_costo' => $id_costo, 'itemes' => $itemes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_trabajo, $id_costo)
    {
        return view('item.create',[
            'id_trabajo'    => $id_trabajo,
            'id_costo'    => $id_costo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @param   int $id_trabajo
     * @param   int $id_costo
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request, $id_trabajo, $id_costo)
    {
        $item = new Item();
        $item->id_costo = $id_costo;
        $item->nombre = $request->nombre;
        $item->cantidad = $request->cantidad;
        $item->precio = $request->precio;
        $item->descuento_bruto = (empty($item->descuento_bruto) ? 0 : $request->descuento_bruto);
        $item->descuento_porcentual = $request->descuento_porcentual;
        $item->es_proveedor = empty($request->es_proveedor) ? false : true;
        $item->save();
        return redirect('trabajo/'.$id_trabajo.'/costo/'.$id_costo)->with('status', '¡Item se ha añadido con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @param  int  $id_item
     * @return \Illuminate\Http\Response
     */
    public function edit($id_trabajo, $id_costo, $id_item)
    {
        $item = Item::find($id_item);
        return view('item.edit', [
            'id_trabajo'    => $id_trabajo,
            'id_costo'      => $id_costo,
            'item'          => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @param  int  $id_item
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItemRequest $request, $id_trabajo, $id_costo, $id_item)
    {
        $item = Item::find($id_item);
        $item->nombre = $request->nombre;
        $item->cantidad = $request->cantidad;
        $item->precio = $request->precio;
        $item->descuento_bruto = (empty($item->descuento_bruto) ? 0 : $request->descuento_bruto);
        $item->descuento_porcentual = $request->descuento_porcentual;
        $item->es_proveedor = empty($request->es_proveedor) ? false : true;
        $item->save();
        return redirect('trabajo/'.$id_trabajo.'/costo/'.$id_costo)->with('status', '¡Item ha sido modificado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_costo
     * @param  int  $id_item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_trabajo, $id_costo, $id_item)
    {
        $item = Item::find($id_item);
        Item::destroy($id_item);
        return redirect('trabajo/'.$id_trabajo.'/costo/'.$id_costo)->with('status', '¡Item ha sido ELIMINADO con éxito!');
    }
}
