<?php

namespace App\Http\Controllers;

use App\SubCategoria;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubController extends Controller
{
    public function __construct(SubCategoria $subCategoria){
        $this->sub = $subCategoria;
    }

    public function index(){
        $sub = $this->sub->where('status', 'A');

        return response()->json($sub, 201);
    }

    public function onCreate(Request $request){
        $input = $request->json()->all();

        $resp = $this->sub->newSub($input);

        if($resp){
            return response()->json(['idSubCategoria' => $resp, 'successMsg' => 'Sub categoria criada com sucesso.'], 201);
        }else{
            return response()->json(['errorMsg' => 'Erro no sistema, tente novamente.'], 200);
        }
    }

    public function onUpdate(Request $request){
        $input = $request->json()->all();

        $sub = $this->sub->find($input['idSubCategoria']);

        $sub->nome = $input['nome'];
        $sub->id_categoria = $input['id_categoria'];
        $sub->save();

        return response()->json(['successMsg' => 'Editado com sucesso.'], 201);
    }

    public function search(Request $request){
        $input = $request->json()->all();

        if(($retorno = $this->sub->busca($input))){
            return response()->json($retorno, 201);
        }else{
            return response()->json(['errorMsg' => 'Nenhum resultado encontrado.'], 200);
        }
    }

    public function onDelete($id){
        $sub = $this->sub->find($id);
        $sub->status = "I";
        $sub->save();

        return response()->json(['successMsg' => 'Removido com sucesso'], 201);
    }

    public function find($id){
        return $this->sub->find($id)->where('status', 'A')->get();


    }
}
