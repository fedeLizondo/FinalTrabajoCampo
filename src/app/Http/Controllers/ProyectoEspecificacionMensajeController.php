<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoEspecificacionMensajeResource;
use App\Models\Especificacion;
use App\Models\Mensaje;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoEspecificacionMensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyecto $proyecto, Especificacion $especificacion)
    {
        return ProyectoEspecificacionMensajeResource::collection($especificacion->mensajes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto, Especificacion $especificacion)
    {

        //Validar si esta auth auth('api')->user();

        if (is_null($request->mensaje) || empty($request->mensaje)) {
            return response(array("data" => ["messages" => ["Debe enviar un mensaje"]]), 400);
        }

        $mensaje = Mensaje::create([
            'proyecto_id' => null,
            'diagrama_id' => null,
            'especificacion_id' => $especificacion->id,
            'user_id' => $request->user,
            'mensaje' => $request->mensaje
        ]);

        return new ProyectoEspecificacionMensajeResource($mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto, Especificacion $especificacion, Mensaje $mensaje)
    {
        return new ProyectoEspecificacionMensajeResource($mensaje);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto, Especificacion $especificacion, Mensaje $mensaje)
    {
        if (is_null($request->mensaje) || empty($request->mensaje)) {
            return response(array("data" => ["messages" => ["Debe enviar un mensaje"]]), 400);
        }
        $mensaje->update($request->only(['mensaje']));
        return new ProyectoEspecificacionMensajeResource($mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto, Especificacion $especificacion, Mensaje $mensaje)
    {
        $mensaje->delete();
        return response()->json(null, 204);
    }
}
