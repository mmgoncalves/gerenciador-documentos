<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Adm extends Model implements AuthenticatableContract
{
    use Authenticatable;

    public $timestamps = false;
    protected $primaryKey = 'idAdm';
    protected $hidden = ['password'];
    protected $fillable = ['nome','cpf', 'password', 'ultimo_acesso', 'status'];

    /*
     * BUSCA TODOS OS REGISTROS
     */
    public function listAll(){
        $query = DB::select('SELECT nome, cpf, status, idAdm FROM adms');

        return $query;
    }

    /*
     * RECEBE DADOS DE UM INPUT, E REALIZA A BUSCA POR NOME OU CPF
     */
    public function search($input){
        if(isset($input['busca'])){
            $sql = 'SELECT nome, cpf, status, idAdm FROM adms ';
            $where = '';

            // separa as palavras em array
            $arrBusca = explode(' ', $input['busca']);
            $qtd = count($arrBusca);

            // verifica se o array contem apenas uma posicao, e se o valor digitado foi numerico (busca por cpf)
            if($input['busca'] == ""){
                $where = " WHERE ";
            }else if($qtd == 1 && is_numeric($arrBusca[0])){
                $where = ' WHERE cpf LIKE "%'.$arrBusca[0].'%" AND ';
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
        if(isset($input['password'])){
            $input['password'] = md5($input['password']);
        }

        $input['ultimo_acesso'] = date('Y-m-d');

        $create = $this->create($input);

        if($create->attributes['idAdm'] > 0){
            return $create->attributes['idAdm'];
        }else{
            return false;
        }
    }

    /*
     * Verifica os dados de um adm, e autentica no sistema
     */
    public function authAdm($input){
        $sql = 'SELECT idAdm FROM adms WHERE cpf = :cpf AND password = md5(:password)';

        $auth = DB::select($sql, [':cpf' => $input['cpf'], ':password' => $input['password']]);

        if(count($auth) == 1 && ($adm = $this->find($auth[0]->idAdm))){
            // guarda no variavel retorno as informacoes do administrador
            $retorno = $adm;
            // altera a data do ultimo acesso do administrador no sistema
            $adm->ultimo_acesso = date('Y-d-m');
            $adm->save();
            // retorna os dados do administrador
            return $retorno;
        }else{
            return false;
        }
    }
}
