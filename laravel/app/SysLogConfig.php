<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysLogConfig extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idLogConfig';
    protected $table = 'sys_log_configs';
}
