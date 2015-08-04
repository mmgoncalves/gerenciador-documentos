<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Adm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return response()->json($adm, 201);
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
            return response()->json(['idAdm' => $idAdm, 'successMsg' => 'Administrador cadastrado com sucesso.'], 201);
        }else{
            return response()->json(['erroMsg' => 'Erro no sistema, tente novamente.'], 200);
        }
    }

    public function onUpdate(Request $request){
        $input = $request->json()->all();

        $adm = $this->adm->find($input['idAdm']);

        $adm->nome = $input['nome'];
        $adm->login = $input['login'];
        $adm->senha = md5($input['senha']);

        $adm->save();

        return response()->json(['idAdm' => $adm->idAdm, 'successMsg' => "Atualizado com sucesso."], 201);
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

    /*
     * Metodo que faz a autenticacao do adm no sistema
     */
    public function onAuth(Request $request){
        Auth::logout();
        $input = $request->all();

        if(($idAdm = $this->adm->authAdm($input))){
            $adm = $this->adm->find($idAdm);
            Auth::login($adm);
        }

        if(Auth::check()){
            return response()->json(['idAdm' => $idAdm], 201);
        }else{
            return response()->json(['errorMsg' => 'Login ou senha incorretos.'], 200);
        }

        /*
        $input = $request->json()->all();

        if(($retorno = $this->adm->authAdm($input))){
            return response()->json(['idAdm' => $retorno], 201);
        }else{
            return response()->json(['errorMsg' => 'Login ou senha incorretos.'], 200);
        }*/


    }
}
