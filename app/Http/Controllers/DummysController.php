<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DummysController extends Controller
{
    public function index(){
        try{
            if(DB::connection()->getDatabaseName()){
                echo "Conexion a base de datos hecha: " . DB::connection()->getDatabaseName();
                // $datos = DB::table("test")->where("NOMBRE",'Manuel')->get();
            }else{
                die("No se encontró base de datos.");
            }
        }catch(\Exception $e){
            die("No se pudo conectar a la base de datos. Error: " . $e);
        }
    }
}
