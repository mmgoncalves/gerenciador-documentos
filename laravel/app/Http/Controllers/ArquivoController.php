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
    public function create(Request $request){
        $input = $request->json()->all();

        $resp = $this->arq->newArq($input);
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
