<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    public function __construct(Categoria $categoria){
        $this->cat = $categoria;
    }

    public function index(){
        $cat = $this->cat->all();

        return response()->json($cat, 201);
    }
}
