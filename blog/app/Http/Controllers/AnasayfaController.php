<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function index(){
        $isim = "Metehan";
        $soyIsim = "SAKA";
        return view('Anasayfa',compact('isim','soyIsim'));
    }
}
