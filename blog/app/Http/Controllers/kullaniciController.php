<?php

namespace App\Http\Controllers;

use App\kullaniciModel;
use App\Mail\kullaniciMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $this->validate(request(),[
            'ad_soyad' => 'required|min:5|max:50',
            'mail' => 'mail|unique:kullanici',
            'sifre' => 'required|confirmed|min:5|max:50'
        ]);
        $kullanici = kullaniciModel::create([
            'ad_soyad' => request('ad_soyad'),
            'mail' => request('email'),
            'sifre' => Hash::make(request('sifre')),
            'aktivasyon' => Str::random(60),
            'aktif' => 0
        ]);
        Mail::to(request('email'))->send(new kullaniciMail($kullanici));
        auth()->login($kullanici);
        return redirect()->route('anasayfa');
    }

        public function aktivasyon($aktivasyon){
            $kullanici = kullaniciModel::where('aktivasyon',$aktivasyon)->first();
            if (!is_null($kullanici)){
                $kullanici->aktivasyon = null;
                $kullanici->aktif = 1;
                $kullanici->save();
                return redirect()->to('/')->with('mesaj','Hesabınız Onaylanmıştır');
            }
        }
}
