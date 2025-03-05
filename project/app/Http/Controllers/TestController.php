<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request){
        return view('test',[
        'prenom' =>$request->prenom,
        'nom' => $request->nom,
        ]); 
    }
}
