<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class HomeController extends Controller
{
    public function getUsuarios(){
        $usuarios = Usuario::all();
        return $usuarios;
    }

    public function getUsuario($id){
        $usuario = Usuario::where('id',$id)->first();
        return $usuario;
    }
}
