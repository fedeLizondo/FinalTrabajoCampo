<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProyectoGrupoResource;
use App\Models\Grupo;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class ProyectoGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyecto $proyecto)
    {
        return ProyectoGrupoResource::collection($proyecto->grupos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyecto $proyecto)
    {
        $user_id = $request->user;
        $email = $request->email;

        if ($proyecto->grupos()->where('user_id', $user_id)->exists()) {
            return response(array("data" => ["messages" => ["el usuario ya se encuentra registrado"]]), 400);
        }

        if ($proyecto->grupos()->where('email', $email)->exists()) {
            return response(array("data" => ["messages" => ["el email ya se encuentra registrado"]]), 400);
        }

        if (is_null($user_id) && is_null($email)) {
            return response(array("data" => ["messages" => ["Debe ingresar almenos el user_id o el mail"]]), 400);
        }

        if (!is_null($user_id)) {
            $user = User::find($user_id);
            if (!is_null($user)) {
                $email = $user->email;
            }
        } else {
            $user = User::where('email', 'ilike',"%".$email."%")->first();
            if (!is_null($user)) {
                $user_id = $user->id;
            }
        }

        $grupo = Grupo::create([
            'user_id' => $user_id,
            'proyecto_id' => $proyecto->id,
            'email' => $email,
            'is_admin' => $request->is_admin
        ]);

        return new ProyectoGrupoResource($grupo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto, Grupo $grupo)
    {
        return new ProyectoGrupoResource($grupo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto, Grupo $grupo)
    {
        if ($grupo->is_admin && $proyecto->grupos()->where('is_admin', true)->count() == 1) {
            return response(array("data" => ["messages" => ["No se le puede quitar el permisos de admin a todos los usuarios"]]), 400);
        }

        $grupo->update($request->only(['is_admin']));

        return new ProyectoGrupoResource($grupo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto, Grupo $grupo)
    {
        if ($grupo->is_admin && $proyecto->grupos()->where('is_admin', 1)->count() == 1) {
            return response(array("data" => ["messages" => ["No se le puede quitar el permisos de admin a todos los usuarios"]]), 400);
        }

        $grupo->delete();
        return response()->json(null, 204);
    }
}
