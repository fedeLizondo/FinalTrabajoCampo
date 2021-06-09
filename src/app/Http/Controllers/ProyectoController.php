<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoResource;
use App\Models\Grupo;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $proyectos = null;
        if (!is_null($search)) {
            $proyectos = Proyecto::where('nombre', 'ilike', '%' . $search . '%')->paginate(50)->withQueryString();
        } else {
            $proyectos = Proyecto::paginate(50)->withQueryString();
        }

        return ProyectoResource::collection($proyectos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar si los parametros son los correctos

        $validated =  $request->validate([
            'nombre' => 'required|max:255',
            'user' => 'required'
        ]);

        //Validar si el nombre esta repetido
        $nombre_user = $request->nombre . '-' . $request->user;

        if (Proyecto::where('user_id', $request->user)->where('nombre', $request->nombre)->exists()) {
            return response(array("data" => ["messages" => ["El nombre del proyecto ya fue utilizado por el usuario"]]), 400);
        }

        $proyecto = Proyecto::create([
            'nombre' => $request->nombre,
            'user_id' => $request->user,
            'nombre_user' => $nombre_user
        ]);


        $user = User::find($request->user);

        Grupo::create([
            'user_id' => $request->user,
            'proyecto_id' => $proyecto->id,
            'email' => $user->email,
            'is_admin' => true
        ]);

        return new ProyectoResource($proyecto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto)
    {
        return new ProyectoResource($proyecto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $proyecto->update($request->only(['nombre']));

        return new ProyectoResource($proyecto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->grupos()->delete();
        $proyecto->diagramas()->delete();
        $proyecto->especificacions()->delete();
        $proyecto->actors()->delete();
        $proyecto->mensajes()->delete();
        $proyecto->favoritos()->delete();
        
        $proyecto->delete();
        return response()->json(null, 204);
    }
}
