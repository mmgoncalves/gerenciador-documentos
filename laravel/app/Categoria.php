<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idCategoria';
    protected $fillable = ['nome', 'status'];

    /*
     * Metodo que cria uma nova categoria no sistema
     */
    public function newCat($input){
        $create = $this->create($input);

        if($create->attributes['idCategoria'] > 0){
            return $create->attributes['idCategoria'];
        }else{
            return false;
        }
    }

    public function busca($input){
        $sql = 'SELECT idCategoria, nome FROM categorias ';
        $where = 'WHERE ';

        $arrBusca = explode(' ', $input['busca']);
        $qtd = count($arrBusca);

        for($i = 0; $i < $qtd; $i++){
            $where .= 'nome LIKE "%'.$arrBusca[$i].'%" AND ';
        }

        $sql .= $where . ' status = "A"';

        $query = DB::select($sql);

        return $query;
    }

    public function buscaSubCategoria($id){
        $sql = 'SELECT cat.nome AS categoria, sub.nome, idSubCategoria FROM categorias AS cat INNER JOIN sub_categorias AS sub ON cat.idCategoria = sub.id_categoria WHERE idCategoria = :id';

        $query = DB::select($sql, [':id' => $id]);

        return $query;
    }

    /*
     * Metodo que faz referencia ao model SubCategoria
     */
    public function subCat(){
        return $this->hasMany('App\SubCategoria');
    }
}
