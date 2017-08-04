<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use Illuminate\Support\Facades\Redirect;
use Storage;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param   int $id_trabajo
     * @return \Illuminate\Http\Response
     */
    public function create($id_trabajo)
    {
        return view('documento.create', ['id_trabajo' => $id_trabajo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_trabajo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_trabajo)
    {
        $documento = new Documento();
        $documento->titulo = $request->titulo;
        $documento->fecha_emision = $request->fecha_emision;
        $documento->comentario = $request->comentario;
        $documento->id_trabajo = $id_trabajo;

        $archivo = $request->file('archivo');
        $ruta = time().'_'.$archivo->getClientOriginalName();
        $documento->peso = $archivo->getSize();
        Storage::disk('archivos')->put($id_trabajo.'/'.$ruta,file_get_contents($archivo->getRealPath()));
        $documento->archivo = $ruta;
        $documento->save();

        return redirect('/trabajo/'.$id_trabajo)->with('mensaje','Documento registrado exitósamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_documento
     * @return \Illuminate\Http\Response
     */
    public function show($id_trabajo, $id_documento)
    {
        $documento = Documento::find($id_documento);
        return view('documento.show', [
            'documento'=>$documento,
            'id_trabajo'=>$id_trabajo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_documento
     * @return \Illuminate\Http\Response
     */
    public function edit($id_trabajo, $id_documento)
    {
        $documento = Documento::find($id_documento);
        return view('documento.edit', [
            'documento' => $documento,
            'id_trabajo'=>$id_trabajo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_trabajo
     * @param  int  $id_documento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_trabajo, $id_documento)
    {
        Documento::destroy($id_documento);
        return redirect('trabajo/'.$id_trabajo)->with('status', '¡Documento eliminado con éxito!');
    }


    public function download($id_trabajo, $id_documento)
    {
        $documento = Documento::find($id_documento);
        $ubicacion = $id_trabajo . '/' . $documento->archivo;
        if (Storage::disk('archivos')->exists($ubicacion)) {
            $path = Storage::disk('archivos')->getDriver()->getAdapter()->applyPathPrefix($ubicacion);
            return response()->download($path);
        }
        return Redirect::route('trabajo.show', [$id_trabajo])->withInput()->withErrors(['error' => 'No se pudo encontrar el archivo.']);
    }

}
