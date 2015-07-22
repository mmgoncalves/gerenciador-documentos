<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArquivoController extends Controller
{
    public function index(){
        return array('teste' => true);
    }

    public function create(){
        return array('create' => false);
    }
}
