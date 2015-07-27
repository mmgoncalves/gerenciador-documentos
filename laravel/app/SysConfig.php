<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysConfig extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idConfig';
    protected $table = 'sys_configs';
    protected $fillable = ['nome', 'logo', 'endereco','numero','bairro', 'cep', 'email', 'cnpj'];

    public function onUpdate($input){
        // buscando o registro
        $config = $this->find($input['idConfig']);

        $config->nome = $input['nome'];
        $config->endereco = $input['endereco'];
        $config->numero = $input['numero'];
        $config->bairro = $input['bairro'];
        $config->cep = $input['cep'];
        $config->email = $input['email'];
        $config->cnpj = $input['cnpj'];

        $config->save();

        return $config->idConfig;
    }
}
