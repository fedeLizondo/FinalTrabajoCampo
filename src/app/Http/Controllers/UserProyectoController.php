<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserProyectoResource;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;

class UserProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return UserProyectoResource::collection(
            $user->grupos()
                ->join('proyectos', 'grupos.proyecto_id', '=', 'proyectos.id')
                ->orderBy('proyectos.created_at','desc')
                ->select('grupos.id')
                ->addSelect('grupos.user_id')
                ->addSelect('proyecto_id')
                ->addSelect('nombre')
                ->addSelect('is_admin')  
                ->addSelect('proyectos.created_at')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(User $user,Proyecto $proyecto)
    {  
        $proyecto->mensajes()->delete();
        $proyecto->actors()->delete();
        $proyecto->diagramas()->delete();
        $proyecto->especificacions()->delete();
        $proyecto->grupos()->delete();
        $proyecto->favoritos()->delete();
        $proyecto->delete();

        return response()->json(null, 204);
    }
}
