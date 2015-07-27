<?php

namespace App\Http\Controllers;

use App\SysConfig;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function __construct(SysConfig $config){
        $this->config = $config;
    }

    /*
     * Metodo para buscar as configuracoes do sistema
     */
    public function index(){
        $config = $this->config->all()->first();

        return response()->json($config, 201);
    }

    /*
     * Metodo para atualizar as configuracoes
     */
    public function onUpdate(Request $request){
        $input = $request->json()->all();

        $resp = $this->config->onUpdate($input);

        return response()->json(["idConfig" => $resp, "successMsg" => utf8_encode("Configurações atualizadas")], 201);
    }
}
