<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $adm = Auth::user();

        //dd($params);
        //$params = ['idAdm' => $adm->idAdm, 'nome' => $adm->nome, 'ultimo_acesso' => $adm->ultimo_acesso];
        return view('home', ['adm' => $adm]);
    }
}
