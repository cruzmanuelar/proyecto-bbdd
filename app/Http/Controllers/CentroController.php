<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentroAcopio;

use Illuminate\Support\Facades\DB;

class CentroController extends Controller
{
    public function getCentros(){
        $centros = CentroAcopio::all();
        return $centros;
    }

    public function getCentro($id){
        $centro = CentroAcopio::where('id',$id)->first();
        return $centro;
    }

    public function registroCentro(Request $request){

        DB::table('centro_acopio')->insert([
            'id' => $request->id,
            'direccion' => $request->direccion,
            'nombre' => $request->nombre,
            'empresa_ruc' => $request->empresa_ruc,
            'centroacopio_producto_id' => $request->centroacopio_producto_id,
        ]);

        $centro = DB::table('centro_acopio')->latest('id')->first();

        // $token = JWTAuth::fromUser($usuario);

        return response()->json(compact('centro'),201);
    }

    public function getNuevos(Request $request){
        
        $productos = CentroAcopio::where('centroacopio_producto_id',$request->centroacopio_producto_id)
            ->where('categoria',2)
            ->orWhere('categoria','nuevo')->get();

        return $productos;
    }

    public function getReciclados($id){
        $productos = CentroAcopio::where('centroacopio_producto_id',$request->centroacopio_producto_id)
            ->where('categoria',1)
            ->orWhere('categoria','reciclado')->get();

        return $productos;
    }
}
