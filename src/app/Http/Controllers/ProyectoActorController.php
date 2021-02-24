<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoActorResource;
use App\Http\Resources\ProyectoResource;
use App\Models\Actor;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyecto $proyecto)
    {
        //$proyecto->actors()->get();
        return ProyectoActorResource::collection($proyecto->actors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        if ($proyecto->actors()->where('nombre', $request->nombre)->exists()) {
            return response(array("data" => ["messages" => ["El actor ya se encuentra dentro del proyecto."]]), 400);
        }

        $actor = Actor::create([
            'proyecto_id' => $proyecto->id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return new ProyectoActorResource($actor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto, Actor $actor)
    {
        return new ProyectoActorResource($actor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto, Actor $actor)
    {

        $actor->update($request->only(['nombre', 'descripcion']));

        return new ProyectoActorResource($actor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto, Actor $actor)
    {
        $actor->delete();
        return response()->json(null, 204);
    }
}
