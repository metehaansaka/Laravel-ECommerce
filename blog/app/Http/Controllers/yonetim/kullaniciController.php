<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;
use App\kullaniciModel;
use App\Models\kullaniciDetayModel;
use Illuminate\Http\Request;
use Auth;
use Hash;

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

    public function index(){
        $kullanicilar = kullaniciModel::orderByDesc('oluşturulma_tarihi')->paginate(8);
        return view('yonetim.kullanici.liste',compact('kullanicilar'));
    }

    public function form($id = 0){
        $kullanici = new kullaniciModel;
        if ($id>0){
            $kullanici = kullaniciModel::find($id);
        }
        return view('yonetim.kullanici.form',compact('kullanici'));
    }

    public function kaydet($id = 0){
        $this->validate(\request(),[
            'mail' => 'email|required',
            'ad_soyad' => 'required'
        ]);

        $data = [
            'mail' => \request('mail'),
            'ad_soyad' => \request('ad_soyad'),
        ];

        if(\request()->filled('sifre')){
            $data['sifre'] = Hash::make(\request('sifre'));
        }
        if (\request()->has('yonetici')){
            $data['yonetici'] = 1;
        }else{
            $data['yonetici'] = 0;
        }


        if ($id > 0){
            $kullanici = kullaniciModel::find($id);
            $kullanici->update($data);
            kullaniciDetayModel:: where('kullanici_id',$id)->update(['adres' => \request('adres'),'telefon' => \request('telefon')]);
        }else{
            $kullanici = kullaniciModel::create($data);
        }
        return redirect()->route('yonetim.kullanici.liste');
    }

}