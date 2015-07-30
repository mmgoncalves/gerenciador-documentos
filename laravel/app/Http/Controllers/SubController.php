<?php

namespace App\Http\Controllers;

use App\SubCategoria;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubController extends Controller
{
    public function __construct(SubCategoria $subCategoria){
        $this->sub = $subCategoria;
    }

    public function index(){
        $sub = $this->sub->all();

        return response()->json($sub, 201);
    }
}
