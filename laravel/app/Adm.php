<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Adm extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idAdm';

    protected $fillable = ['nome','login', 'senha', 'ultimo_acesso', 'status'];

    public function listAll(){

        return $this->all();
    }

    public function newAdm($input){
        if(isset($input['senha'])){
            $input['senha'] = md5($input['senha']);
        }

        $input['ultimo_acesso'] = date('Y-m-d');
        $input['status'] = "A";

        $create = $this->create($input);

        if($create->attributes['idAdm'] > 0){
            return $create->attributes['idAdm'];
        }else{
            return false;
        }
    }
}
