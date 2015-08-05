<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SysLog extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idLog';
    protected $table = 'sys_logs';
    protected $fillable = ['data', 'id_adm', 'id_arquivo', 'alteracao'];

    public function newLog($idArq, $alt = ''){
        $log = [
            'id_adm' => Auth::user()->idAdm,
            'id_arquivo' => $idArq,
            'alteracao' => $alt,
            'data' => date('Y-m-d H:i:s')
        ];

        $this->create($log);
    }
}
