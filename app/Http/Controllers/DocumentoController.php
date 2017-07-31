<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use Storage;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = Documento::all();
        return view('documento.index')->with('documentos',$documentos);
    }

    public function create($id)
    {
        return view('documento.create', ['id_trabajo' => $id]);
    }

    public function store(Request $request)
    {


        $documento = new Documento;
        $documento->titulo = $request->titulo;

        $documento->fecha_emision = $request->fecha_emision;

        $documento->comentario = $request->comentario;
        $documento->id_trabajo = $request->id_trabajo;

        $archivo = $request->file('archivo');
        $ruta = time().'_'.$archivo->getClientOriginalName();
        Storage::disk('archivos')->put($ruta,file_get_contents($archivo->getRealPath()));

        $documento->archivo = $ruta;
        $documento->save();

        return redirect('/trabajo/'.$request->id_trabajo)->with('mensaje','Documento registrado exitósamente');
    }

    public function show($id)
    {
        $documento = Documento::find($id);
        return view('documento.show', ['documento'=>$documento,'id_trabajo'=>$documento->id_trabajo]);
    }

    public function edit($id)
    {
        $documento = Documento::find($id);
        return view('documento.edit')->with('documento',$documento);
    }

    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);
        $archivo = $request->file('archivo');
        $ruta = time().'_'.$archivo->getClientOriginalName();
        Storage::disk('archivos')->put($ruta,file_get_contents($archivo->getRealPath()));

        $documento->titulo = $request->titulo;
        $documento->fecha_emision = $request->fecha_emision;
        $documento->comentario = $request->comentario;
        $documento->archivo = $ruta;

        $documento->update();

        return redirect('/documento')->with('mensaje','Documento actualizado exitósamente');
    }

}
