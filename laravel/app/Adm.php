<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Adm extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idAdm';

    protected $fillable = ['nome','login', 'senha', 'ultimo_acesso', 'status'];

    /*
     * BUSCA TODOS OS REGISTROS
     */
    public function listAll(){
        $query = DB::select('SELECT nome, login, status, idAdm FROM adms');

        return $query;
    }

    /*
     * RECEBE DADOS DE UM INPUT, E REALIZA A BUSCA POR NOME OU CPF
     */
    public function search($input){
        if(isset($input['busca'])){
            $sql = 'SELECT nome, login, status, idAdm FROM adms ';
            $where = '';

            // separa as palavras em array
            $arrBusca = explode(' ', $input['busca']);
            $qtd = count($arrBusca);

            // verifica se o array contem apenas uma posicao, e se o valor digitado foi numerico (busca por cpf)
            if($input['busca'] == ""){
                $where = " WHERE ";
            }else if($qtd == 1 && is_numeric($arrBusca[0])){
                $where = ' WHERE login LIKE "%'.$arrBusca[0].'%" AND ';
            }else if($qtd > 0){
                // entra aqui caso a busca seja por nome
                for($i = 0; $i < $qtd; $i++){
                    $where .= ' WHERE nome LIKE "%'.$arrBusca[$i].'%" AND';
                }
            }else{
                // retorna false, caso a busca nao gere nenhum resultado
                return false;
            }

            $sql .= $where . ' status = "A" ORDER BY idAdm DESC';

            $query = DB::select($sql);

            return $query;
        }

        return false;
    }

    /*
     * CADASTRA UM NOVO ADMINISTRADOR NO BANCO
     */
    public function newAdm($input){
        if(isset($input['senha'])){
            $input['senha'] = md5($input['senha']);
        }

        $input['ultimo_acesso'] = date('Y-m-d');
        //$input['status'] = "A";

        $create = $this->create($input);

        if($create->attributes['idAdm'] > 0){
            return $create->attributes['idAdm'];
        }else{
            return false;
        }
    }
}
