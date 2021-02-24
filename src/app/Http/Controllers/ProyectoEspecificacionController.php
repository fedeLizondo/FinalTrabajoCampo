<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoEspecificacionResource;
use App\Models\Especificacion;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoEspecificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyecto $proyecto)
    {
        return ProyectoEspecificacionResource::collection($proyecto->especificacions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        if ($proyecto->especificacions()->where('nombre', $request->nombre)->exists()) {
            return response(array("data" => ["messages" => ["Ya se encuentra una especificación con el mismo nombre."]]), 400);
        }

        $especificacion = Especificacion::create([
            'proyecto_id' => $proyecto->id,
            'nombre' => $request->nombre,
            'documento' => $request->documento,
            'tipo' => $request->tipo
        ]);

        return new ProyectoEspecificacionResource($especificacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto, Especificacion $especificacion)
    {
        return new ProyectoEspecificacionResource($especificacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto, Especificacion $especificacion)
    {
        if ($proyecto->especificacions()->where('nombre', $request->nombre)->exists()) {
            return response(array("data" => ["messages" => ["Ya se encuentra una especificación con el mismo nombre."]]), 400);
        }

        $especificacion->update($request->only(['nombre']));

        return new ProyectoEspecificacionResource($especificacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto, Especificacion $especificacion)
    {
        $especificacion->mensajes()->delete();
        $especificacion->delete();
        return response()->json(null, 204);
    }
}
