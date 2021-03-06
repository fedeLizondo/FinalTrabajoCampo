<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoDiagramaMensajeResource;
use App\Http\Resources\ProyectoDiagramaResource;
use App\Http\Resources\ProyectoEspecificacionMensajeResource;
use App\Models\Diagrama;
use App\Models\Mensaje;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoDiagramaMensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyecto $proyecto, Diagrama $diagrama)
    {
        return ProyectoDiagramaMensajeResource::collection($diagrama->mensajes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto, Diagrama $diagrama)
    {
        if (is_null($request->mensaje) || empty($request->mensaje)) {
            return response(array("data" => ["messages" => ["Debe enviar un mensaje"]]), 400);
        }

        $mensaje = Mensaje::create([
            'proyecto_id' => null,
            'diagrama_id' => $diagrama->id,
            'especificacion_id' => null,
            'user_id' => $request->user,
            'mensaje' => $request->mensaje
        ]);

        return new ProyectoDiagramaMensajeResource($mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto, Diagrama $diagrama, Mensaje $mensaje)
    {
        return new ProyectoDiagramaMensajeResource($mensaje);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto, Diagrama $diagrama, Mensaje $mensaje)
    {
        if (is_null($request->mensaje) || empty($request->mensaje)) {
            return response(array("data" => ["messages" => ["Debe enviar un mensaje"]]), 400);
        }

        $mensaje->update($request->only(['mensaje']));
        return new ProyectoDiagramaMensajeResource($mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto, Diagrama $diagrama, Mensaje $mensaje)
    {
        $mensaje->delete();
        return response()->json(null, 204);
    }
}
