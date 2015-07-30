<?php

namespace App\Http\Controllers;

use App\SysConfig;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use WideImage\WideImage;

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
        /*print_r(__DIR__);

        // verifica se a logo existe
        $file = $_SERVER['HTTP_HOST'] . '/logo/' . $config->logo;


        //$file = 'http://www.domain.com/somefile.jpg';
        $file_headers = @get_headers($file);
        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $config->logo = $file;
        }
        else {
            $config->logo = '';
        }*/

        /*
        if(file_exists($logo)){
            $config->logo = $logo;
        }else{
            //echo $logo;
            $config->logo = '';
        }*/

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

    /*
     * Metodo que recebe a logo via post, e salva na pasta logo
     */
    public function upLogo(Request $request){
        // verifica se a imagme veio via post
        if ($request->hasFile('images')) {
            // recupera o arquivo
            $img = WideImage::loadFromUpload('images');
            //altera o tamanho para 400px, e salva na pasta logo
            $img[0]->resize(400)->saveToFile('logo/logo.jpg');
        }
    }
}
