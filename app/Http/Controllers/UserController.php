<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Compania;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function acceder(Request $request){
        $data = request()->validate([
            'usuario' => "required|string",
            "password" => "required|string",
        ]);

        $usuario = User::query()->with("permisos", 'permisos.entidad', 'compania', 'persona')->withoutGlobalScopes()->whereUsuario($data["usuario"])->whereEstado(1)->first();

        if($usuario == null)
            abort(404, __("errores.usuarioNoExiste"));

        if(Crypt::decryptString($usuario->password) != $data['password'])
            abort(404, __("errores.contrasenaIncorrecta"));

        $permisosConEntidades = $usuario->permisos()->with("entidad")->get();

        $unionDeEntidadesYPermisosSeparadosPorDosPuntos = $permisosConEntidades->map(function($d){
            $entidadYPermisoSeparadosPorDosPuntos = $d->entidad->descripcion . ":" . $d->descripcion;
            return $entidadYPermisoSeparadosPorDosPuntos;
        });

        $token = $usuario->createToken(config('app.key'), $unionDeEntidadesYPermisosSeparadosPorDosPuntos->toArray())->plainTextToken;

        return response([
            "usuario" => new UserResource($usuario),
//            "apiKey" => \App\Classes\Helper::jwtEncode($usuario->usuario),
            "apiKey" => "",
            "moneda" => $usuario->compania->moneda,
            "token" => $token
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
