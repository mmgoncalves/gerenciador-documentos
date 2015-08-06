<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Arquivo extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idArquivo';
    protected $fillable = ['idArquivo', 'edicao', 'titulo', 'conteudo', 'descricao', 'anexo', 'certificado', 'dataHora', 'dataHoraCriacao', 'id_adm', 'id_categoria', 'id_subCategoria', 'status'];

    /*
     * Metodo que cria um novo arquivo
     */
    public function newArq($input){
        // formatando a data
        $input['dataHora'] = $this->formataDataHora($input['dataHora']);

        // salvando o anexo
        if(isset($input['anexo'])){
            $this->salvaAnexo();
        }

        // setando id do adm e data da criacao
        $input['dataHoraCriacao'] = date('Y-m-d H:i:s');
        $input['id_adm'] = Auth::user()->idAdm;

        $resp = $this->create($input);
        return $resp;
    }

    private function salvaAnexo(){

    }

    private function formataDataHora($dataHora){
        $dataHora .= ':00';
        $data1 = \DateTime::createFromFormat("d/m/Y H:i:s", $dataHora);
        return $data1->format("Y-m-d H:i:s");
    }
}
