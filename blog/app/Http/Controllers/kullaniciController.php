<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kullaniciController extends Controller
{
    public function giris(){
        return view('kullanici.oturumac');
    }
    public function kaydol(){
        return view('kullanici.kaydol');
    }
}
