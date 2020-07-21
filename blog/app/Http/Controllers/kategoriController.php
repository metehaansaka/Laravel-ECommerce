<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index(){
        return view('kategori');
    }
}
