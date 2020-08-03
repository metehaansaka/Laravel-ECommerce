<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class kullaniciController extends Controller
{
    public function oturumac(){
        if (request()->isMethod('post')){

            $this->validate(request(),[
                'email' => 'email|required',
                'sifre' => 'required'
            ]);

            $credentials = [
                'mail' => request('email'),
                'password' => \request('sifre'),
                'yonetici' => 1
            ];

            if (Auth::guard('yonetim')->attempt($credentials,\request()->has('beni_hatirla'))){
                return redirect()->route('yonetim.anasayfa');
            }else{
                return back()->withInput()->withErrors(['email' => 'Giriş Hatalı']);
            }

        }else{
            return view('yonetim.oturumac');
        }
    }

    public function oturumkapat(){
        Auth::guard('yonetim')->logout();
        session()->flush();
        session()->regenerate();
        return redirect()->route('yonetim.oturumac');
    }

}
