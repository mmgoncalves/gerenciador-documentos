<?php

namespace App\Http\Controllers;

use App\Arquivo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;


class ArquivoController extends Controller
{
    public function __construct(Arquivo $arquivo){
        $this->arq = $arquivo;
    }

    /*
     * RETORNA TODOS OS ARQUIVOS
     */
    public function index(){
        $arq = $this->arq->where(['status' => 'A'])->get();

        return response()->json($arq, 201);
    }

    /*
     * CRIA NOVO ARQUIVO
     */
    public function onCreate(Request $request){
        // recuperando os dados da requisica
        $input = $request->all();

        // verificando se houve upload de um anexo
        if(Input::file('anexo')->isValid()){
            $input['file'] = Input::file('anexo');
        }

        // chamando o metodo que salva os dados no banco
        $resp = $this->arq->newArq($input);

        // se os dados foram salvos com sucesso, redireciona para pagina principal
        if($resp){
            return redirect('/home#/st/1');
        }

        // em caso de erro
        return redirect('/home#/st/2');
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
        $input = $request->json()->all();
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
        $arq = $this->arq->find($id);
        $arq->status = "I";

        $arq->save();

        return response()->json([], 201);
    }
}
