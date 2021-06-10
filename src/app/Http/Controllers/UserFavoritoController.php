<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserFavoritoResource;
use App\Models\Favorito;
use App\Models\User;
use Illuminate\Http\Request;

class UserFavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return UserFavoritoResource::collection($user->favoritos()    
        ->join('proyectos', 'favoritos.proyecto_id', '=', 'proyectos.id')
        ->orderBy('proyectos.created_at','asc')
        ->select('favoritos.id')
        ->addSelect('favoritos.user_id')
        ->addSelect('proyecto_id')
        ->addSelect('nombre')
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
    public function store(Request $request, User $user){
        
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
    public function destroy(User $user, Favorito $favorito)
    {   
        $favorito->delete();
        return response()->json(null, 204);
    }
}
