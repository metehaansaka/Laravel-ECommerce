<?php

namespace App\Http\Controllers;

use App\kullaniciModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class kullaniciController extends Controller
{
    public function giris(){
        return view('kullanici.oturumac');
    }

    public function kaydol_form(){
        return view('kullanici.kaydol');
    }

    public function kaydol(){
        $kullanici = kullaniciModel::create([
            'ad_soyad' => request('ad_soyad'),
            'mail' => request('email'),
            'sifre' => Hash::make(request('sifre')),
            'aktivasyon' => Str::random(60),
            'aktif' => 0
        ]);
        auth()->login($kullanici);
        return redirect()->route('anasayfa');
    }
}
