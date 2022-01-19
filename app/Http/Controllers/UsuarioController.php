<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Persona;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsuarioController extends Controller
{
    public function registroUsuario(Request $request){

        DB::table('usuario')->insert([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'correo' => $request->correo,
            'id' => $request->id,
            'contraseÑa' => $request->contraseÑa,
        ]);

        $usuario = DB::table('usuario')->latest('id')->first();

        // $token = JWTAuth::fromUser($usuario);

        return ['usuario' => $sesion, "res" => true];
    }

    public function getPuntos(Request $request){

        $puntos = Persona::where('usuario_id',$request->id)->first();
        return $puntos;
    }

    public function login(Request $request){

        $correo = $request->correo;
        $contraseña = $request->contraseña;

        $usuarioRol = "";

        if(Usuario::where('correo',$correo)->where('contraseña', $contraseña)->exists()){
            
            $sesion = Usuario::where('correo',$correo)->where('contraseña', $contraseña)->get();

            $idUsuario = $sesion[0]['id'];

            if(Empresa::where('usuario_id',$sesion[0]['id'])->exists()){

                $rol = "Empresa";
                $usuarioRol = Empresa::where('usuario_id',$idUsuario)->get();
                
            }else{
                $rol = "Persona";
                $usuarioRol = Persona::where('usuario_id',$idUsuario)->get();
            }

            return ['usuario' => $sesion, 'usuarioRol' => $usuarioRol, "res" => true, 'rol' => $rol];
        }else{
            return ['res' => false];
        }


    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('correo', 'contraseña');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
            }
            return response()->json(compact('user'));
    }
}
