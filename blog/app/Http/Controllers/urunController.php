<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class urunController extends Controller
{
    public function index(){
        return view('urun');
    }
}
