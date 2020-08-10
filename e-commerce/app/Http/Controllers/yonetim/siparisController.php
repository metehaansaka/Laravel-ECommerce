<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;
use App\Models\siparisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class siparisController extends Controller
{
    public function index(){
        if (\request()->filled('aranan')){
            \request()->flash();
            $aranan = \request('aranan');
            $kullanicilar = siparisModel::with('sepet.kullanici')
                ->where('id','like',"%$aranan%")
                ->orWhere('ad_soyad',$aranan)
                ->orderByDesc('oluşturulma_tarihi')
                ->paginate(5)
                ->appends('aranan',$aranan);
        }
        else {
            \request()->flush();
            $kullanicilar = siparisModel::with('sepet.kullanici')->orderByDesc('oluşturulma_tarihi')->paginate(5);
        }
        return view('yonetim.siparis.liste',compact('kullanicilar'));
    }

    public function form($id = 0){
        if ($id>0){
            $kullanici = siparisModel::with('sepet.sepet_urunler.urun')->find($id);
            $kullanici2 = siparisModel::with('sepet.kullanici')->find($id);
        }
        return view('yonetim.siparis.form',compact('kullanici','kullanici2'));
    }

    public function kaydet($id = 0){

        $this->validate(\request(),[
            'fiyat' => 'required',
            'durum' => 'required'
        ]);

        $data = [
            'fiyat' => \request('fiyat'),
            'durum' => \request('durum')
        ];

        if ($id > 0){
            $kullanici = siparisModel::find($id);
            $kullanici->update($data);
        }
        return redirect()->route('yonetim.siparis.duzenle',$kullanici->id);
    }

    public function sil($id){
        siparisModel::destroy($id);
        return redirect()->route('yonetim.siparis.liste');
    }
}
