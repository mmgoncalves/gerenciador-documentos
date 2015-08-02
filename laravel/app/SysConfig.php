<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysConfig extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idConfig';
    protected $table = 'sys_configs';
    protected $fillable = ['nome', 'logo', 'endereco','numero','bairro', 'cep', 'email', 'cnpj', 'site'];

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
        $config->site = $input['site'];

        $config->save();

        return $config->idConfig;
    }

    public function verificaUrl($url) {
        $file_headers = @get_headers($url);

        if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
            return FALSE;
        }else if ($file_headers[0] == 'HTTP/1.1 302 Found' && $file_headers[7] == 'HTTP/1.1 404 Not Found'){
            return FALSE;
        }

        return TRUE;
    }
}
