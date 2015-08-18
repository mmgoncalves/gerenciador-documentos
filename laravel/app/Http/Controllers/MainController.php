<?php

namespace App\Http\Controllers;

use App\Arquivo;
use App\SysConfig;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function __construct(Arquivo $arquivo){
        $this->arq = $arquivo;
    }

    public function index(){
        // recuperar dados de configuracoes e chamar a view
        $config = SysConfig::all()->first();

        return view('main', ['config' => $config]);
    }
}
