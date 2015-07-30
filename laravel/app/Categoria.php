<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idCategoria';
    protected $fillable = ['nome'];

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

    /*
     * Metodo que faz referencia ao model SubCategoria
     */
    public function subCat(){
        return $this->hasMany('App\SubCategoria');
    }
}
