<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SysLogConfig extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idLogConfig';
    protected $table = 'sys_log_configs';
    protected $fillable = ['id_adm', 'data', 'alteracao'];

    public function newLog(){
        $log = ['id_adm' => Auth::user()->idAdm, 'data' => date('Y-m-d H:i:s')];
        $this->create($log);
    }
}
