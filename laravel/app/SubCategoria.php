<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idSubCategoria';
    protected $table = 'sub_categorias';
    protected $fillable = ['nome', 'id_categoria'];

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

    /*
     * Metodo que faz referencia ao model categoria
     */
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
