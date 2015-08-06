<?php

namespace App\Http\Controllers;

use App\Arquivo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArquivoController extends Controller
{
    public function __construct(Arquivo $arquivo){
        $this->arq = $arquivo;
    }

    /*
     * CRIA NOVO ARQUIVO
     */
    public function onCreate(Request $request){
        $input = $request->all();

        $resp = $this->arq->newArq($input);

        if(isset($resp['idArquivo'])){
            return redirect('/home#/');
            //return response()->json($resp, 201);
        }else{
            return response()->json(['errorMsg' => 'Erro no sistema, tente novamente.'], 200);
        }

    }

    /*
     * BUCSA ARQUIVO PELO ID
     */
    public function find($id){

    }

    /*
     * RETORNA TODOS OS REGISTROS
     */
    public function listAll(){

    }

    /*
     * BUSCA POR FILTROS
     */
    public function search(Request $request){

    }

    /*
     * ATUALIZA UM REGISTRO
     */
    public function onUpdate(Request $request){

    }

    /*
     * DESABILITA UM REGISTRO
     */
    public function onDelete($id){

    }
}
