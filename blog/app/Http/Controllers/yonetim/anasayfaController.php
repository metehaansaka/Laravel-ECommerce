<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class anasayfaController extends Controller
{
    public function index(){
        return view('yonetim.anasayfa');
    }
}
