<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArquivoController extends Controller
{
    /*
     * CRIA NOVO ARQUIVO
     */
    public function create(){
        return array('create' => false);
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
