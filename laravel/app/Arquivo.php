<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Arquivo extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idArquivo';
    protected $fillable = ['idArquivo', 'edicao', 'titulo', 'conteudo', 'descricao', 'anexo', 'certificado', 'dataHora', 'dataHoraCriacao', 'id_adm', 'id_categoria', 'id_subCategoria', 'status'];
    protected $hidden = ['dataHoraCriacao', 'status', 'id_adm'];

    /*
     * Metodo que faz a busca por filtros
     */
    public function buscaFiltro($input){
        $sql = 'SELECT idArquivo, edicao, titulo, conteudo, descricao, anexo, certificado, DATE_FORMAT(dataHora, "%d/%m/%Y %H:%i") AS dataHora, id_categoria, id_subCategoria, cat.nome AS categoria FROM arquivos AS a INNER JOIN categorias AS cat ON cat.idCategoria = a.id_categoria ';
        $where = ' WHERE a.status = "A" ';

        if(isset($input['id_categoria']) && $input['id_categoria'] != ""){
            $where .= ' AND id_categoria = '. $input['id_categoria'];
        }

        if(isset($input['id_subCategoria']) && $input['id_subCategoria'] != ""){
            $where .= ' AND id_subCategoria = '. $input['id_subCategoria'];
        }

        if(isset($input['edicao']) && $input['edicao'] != ""){
            $where .= ' AND edicao = '. $input['edicao'];
        }

        if(isset($input['titulo']) && $input['titulo'] != ""){
            $where .= ' AND titulo LIKE "%' . $input['titulo'] . '%"';
        }

        if(isset($input['descricao']) && $input['descricao'] != ""){
            $where .= ' AND descricao LIKE "%' . $input['descricao'] . '%"';
        }

        if(isset($input['data']) && $input['data'] != ""){
            $data = $this->formataData($input['data']);
            $where .= ' AND DATE(dataHora) = "' . $data . '"';
        }

        $sql .= $where;


        $query = DB::select($sql);

        return $query;
    }


    /*
     * Metodo que faz a busca por filtros
     */
    public function edicoes(){
        $sql = 'SELECT DISTINCT(edicao) FROM arquivos WHERE status = "A"';
        $query = DB::select($sql);

        return $query;
    }

    /*
     * Metodo que cria um novo arquivo
     */
    public function newArq($input){
        // formatando a data
        $input['dataHora'] = $this->formataDataHora($input['dataHora']);

        // setando id do adm e data da criacao
        $input['dataHoraCriacao'] = date('Y-m-d H:i:s');
        $input['id_adm'] = Auth::user()->idAdm;

        // Verifica se existe upload de anexo
        if(isset($input['file'])){
            // chama o metodo que salva o anexo e retorna o caminho do arquivo anexo
            $anexo = $this->salvaAnexo($input['file'], $input['id_adm']);

            // seta o caminho completo do arquivo anexo
            $input['anexo'] = $anexo;
        }

        // salva os dados no banco
        $resp = $this->create($input);

        // verifica se os dodos foram salvos e retorna TRUE em caso de sucesso
        return isset($resp['idArquivo']);
    }

    private function salvaAnexo($file, $idAdm){
        // monta a pasta onde sera salvo o anexo
        $destination = 'anexo/' . date('Y') . '/' . date('m') . '/' . date('d');

        // recupera a extensao original do arquivo
        $ext = $file->getClientOriginalExtension();

        // monta o nome do arquivo
        $fileName = $idAdm . '-' .date('YmdHis') . '.' . $ext;

        // move o arquivo para a pasta escolhida, com o nome escolhido
        $file->move($destination, $fileName);

        // retorna o destino completo do arquivo no sistema
        return $destination . '/' . $fileName;
    }

    private function formataDataHora($dataHora){
        $dataHora .= ':00';
        $data = \DateTime::createFromFormat("d/m/Y H:i:s", $dataHora);
        return $data->format("Y-m-d H:i:s");
    }

    private function formataData($data_BR){
        $data_US = implode('-', array_reverse(explode('/', $data_BR)));
        return $data_US;
    }
}
