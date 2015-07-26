<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Adm;
use Illuminate\Http\Request;

class AdmController extends Controller
{
    public function index(){

    }

    public function find($id){

    }

    public function listAll(){
        $admDao = new Adm();

        return array($admDao->listAll());
    }

    public function search(Request $request){
        $input = $request->json()->all();

        $admDao = new Adm();
        if(($retorno = $admDao->search($input))){

            return response()->json($retorno, 201);
        }else{
            return response()->json(['erroMsg' => 'Nenhum resultado encontrado.'], 200);
        }
    }

    public function create(Request $request){
        $input = $request->json()->all();
        $admDao = new Adm();
        if(($idAdm = $admDao->newAdm($input))){
            return response()->json(['idAdm' => $idAdm], 201);
        }else{
            return response()->json(['erroMsg' => 'Erro no sistema, tente novamente.'], 200);
        }
    }
}
