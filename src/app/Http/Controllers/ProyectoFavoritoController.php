<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoFavoritoResource;
use App\Http\Resources\ProyectoMensajeResource;
use App\Models\Favorito;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;

class ProyectoFavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyecto $proyecto)
    {
        return ProyectoFavoritoResource::collection($proyecto->favoritos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto)
    {

        if (is_null($request->user) || is_null(User::find($request->user))) {
            return response(array("data" => ["messages" => ["El usuario es invalido"]]), 400);
        }

        if ($proyecto->favoritos()->where('user_id', $request->user)->exists()) {
            return response(array("data" => ["messages" => ["Ya se encuentra registrado en favoritos"]]), 200);
        }

        $favorito = Favorito::create([
            'user_id' => $request->user,
            'proyecto_id' => $proyecto->id
        ]);

        return new ProyectoFavoritoResource($favorito);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto, Favorito $favorito)
    {
        $favorito->delete();
        return response()->json(null, 204);
    }
}
