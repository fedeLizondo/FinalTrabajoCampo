<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoActorResource;
use App\Http\Resources\ProyectoDiagramaResource;
use App\Models\Diagrama;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoDiagramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyecto $proyecto)
    {
        return ProyectoDiagramaResource::collection($proyecto->diagramas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        if ($proyecto->diagramas()->where('nombre', $request->nombre)->exists()) {
            return response(array("data" => ["messages" => ["Ya se encuentra un diagrama con el mismo nombre."]]), 400);
        }

        $diagrama = Diagrama::create([
            'proyecto_id' => $proyecto->id,
            'nombre' => $request->nombre,
            'documento' => $request->documento,
            'tipo' => $request->tipo
        ]);

        return new ProyectoDiagramaResource($diagrama);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto, Diagrama $diagrama)
    {
        return new ProyectoDiagramaResource($diagrama);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto, Diagrama $diagrama)
    {
        if ($proyecto->diagramas()->where('nombre', $request->nombre)->count() >= 1) {
            return response(array("data" => ["messages" => ["Ya hay un diagrama con el mismo nombre"]]), 400);
        }

        $diagrama->update($request->only(['nombre']));

        return new ProyectoDiagramaResource($diagrama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto, Diagrama $diagrama)
    {
        $diagrama->mensajes()->delete();
        $diagrama->delete();
        return response()->json(null, 204);
    }
}
