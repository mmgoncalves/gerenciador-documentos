<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysConfig extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idConfig';
    protected $table = 'sys_configs';
}
