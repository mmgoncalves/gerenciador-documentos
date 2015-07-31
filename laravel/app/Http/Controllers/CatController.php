<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    public function __construct(Categoria $categoria){
        $this->cat = $categoria;
    }

    public function index(){
        $cat = $this->cat->all();

        return response()->json($cat, 201);
    }

    public function onCreate(Request $request){
        $input = $request->json()->all();

        $resp = $this->cat->newCat($input);

        if($resp){
            return response()->json(['idCategoria' => $resp, 'successMsg' => 'Categoria criada com sucesso.'], 201);
        }else{
            return response()->json(['errorMsg' => 'Erro no sistema, tente novamente.'], 200);
        }
    }

    public function search(Request $request){
        $input = $request->json()->all();

        if(($retorno = $this->cat->busca($input))){
            return response()->json($retorno, 201);
        }else{
            return response()->json(['errorMsg' => 'Nenhum resultado encontrado.'], 200);
        }
    }

}
