<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysLog extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idLog';
    protected $table = 'sys_logs';
}
