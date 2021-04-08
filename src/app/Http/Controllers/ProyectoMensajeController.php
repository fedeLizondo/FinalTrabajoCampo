<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoMensajeResource;
use App\Models\Mensaje;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;

class ProyectoMensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyecto $proyecto)
    {
        return ProyectoMensajeResource::collection(
            $proyecto->mensajes()
            ->join('users', 'users.id', '=', 'mensajes.user_id')
                /*->orderBy('proyectos.created_at','desc')*/
                ->select('mensajes.*')
                ->addSelect('users.name')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        if (is_null($request->mensaje) || empty($request->mensaje)) {
            return response(array("data" => ["messages" => ["Debe enviar un mensaje"]]), 400);
        }

        $mensaje = Mensaje::create([
            'proyecto_id' => $proyecto->id,
            'diagrama_id' => null,
            'especificacion_id' => null,
            'user_id' => $request->user,
            'mensaje' => $request->mensaje
        ]);

        return new ProyectoMensajeResource($mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto, Mensaje $mensaje)
    {
        return new ProyectoMensajeResource($mensaje);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto, Mensaje $mensaje)
    {
        if (is_null($request->mensaje) || empty($request->mensaje)) {
            return response(array("data" => ["messages" => ["Debe enviar un mensaje"]]), 400);
        }

        $mensaje->update($request->only(['mensaje']));
        return new ProyectoMensajeResource($mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto, Mensaje $mensaje)
    {
        $mensaje->delete();
        return response()->json(null, 204);
    }
}
