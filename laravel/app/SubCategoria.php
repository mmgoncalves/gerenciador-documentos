<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategoria extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idSubCategoria';
    protected $table = 'sub_categorias';
    protected $fillable = ['nome', 'id_categoria', 'status'];

    /*
     * Metodo para criar nova sub categoria
     */
    public function newSub($input){
        $create = $this->create($input);

        if($create->attributes['idSubCategoria'] > 0){
            return $create->attributes['idSubCategoria'];
        }else{
            return false;
        }
    }

    public function busca($input){
        $sql = 'SELECT idSubCategoria, sub.nome, cat.nome AS categoria, id_categoria FROM sub_categorias AS sub INNER JOIN categorias AS cat ON id_categoria = cat.idCategoria ';
        $where = 'WHERE ';

        $arrSub = explode(' ', $input['busca']);
        $qtd = count($arrSub);

        for($i = 0; $i < $qtd; $i++){
            $where .= ' sub.nome LIKE "%'.$arrSub[$i].'%" AND ';
        }

        $sql .= $where . ' sub.status = "A"';

        $query = DB::select($sql);

        return $query;
    }

    /*
     * Metodo que faz referencia ao model categoria
     */
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
