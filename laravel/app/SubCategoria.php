<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idSubCategoria';
    protected $table = 'sub_categorias';
    protected $fillable = ['nome', 'id_categoria'];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
