<?php

namespace App\Http\Controllers;

use App\Models\siparisModel;
use Cart;
use Illuminate\Http\Request;

class odemeController extends Controller
{
    public function index(){
        if (!auth()->check()){
            return redirect()->route('kullanici.oturumac');
        }else{
            $kullanici = auth()->user()->kullaniciDetay;
            return view('odeme',compact('kullanici'));
        }
    }

    public function odeme(){
        $siparis = request()->all();
        $siparis['sepet_id'] = session('aktif_sepet_id');
        $siparis['durum'] = "Sipariş Alındı";
        $siparis['banka'] = "Garanti Bankası";
        $siparis['taksit_sayisi'] = 3;
        $siparis['fiyat'] = Cart::getTotal();
        siparisModel::create($siparis);
        Cart::clear();
        session()->forget('aktif_sepet_id');
        return redirect()->route('siparis');
    }

}
