<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Adm;
use Illuminate\Http\Request;

class AdmController extends Controller
{
    public function __construct(Adm $adm){
        $this->adm = $adm;
    }

    /*
     * Metodo para encontrar um administrador por id
     */
    public function find($id){
        $adm = $this->adm->find($id);

        print_r($adm);
        return $adm;
    }

    /*
     * Faz a busca por adm, por nome ou cpf
     */
    public function search(Request $request){
        $input = $request->json()->all();

        if(($retorno = $this->adm->search($input))){

            return response()->json($retorno, 201);
        }else{
            return response()->json(['erroMsg' => 'Nenhum resultado encontrado.'], 200);
        }
    }

    /*
     * Metodo para criar novo administrador
     * FALTA VERIFICA SE O CPF JA EXISTE
     */
    public function onCreate(Request $request){
        $input = $request->json()->all();

        if(($idAdm = $this->adm->newAdm($input))){
            return response()->json(['idAdm' => $idAdm], 201);
        }else{
            return response()->json(['erroMsg' => 'Erro no sistema, tente novamente.'], 200);
        }
    }

    /*
     * Metodo para deletar um administrador
     */
    public function onDelete($id){
        $adm = $this->adm->find($id);
        $adm->status = "I";
        $adm->save();

        return response()->json([], 201);
    }
}
