<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idArquivo';
    protected $fillable = ['edicao', 'titulo', 'descricao', 'anexo', 'certificado', 'dataHora', 'dataHoraCriacao', 'id_adm', 'id_categoria', 'id_subCategoria', 'status'];


}
