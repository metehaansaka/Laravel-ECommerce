<?php

namespace App\Http\Controllers;

use App\Models\siparisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class siparisController extends Controller
{
    public function index(){
        $siparisler = siparisModel::with('sepet')
            ->whereHas('sepet',function ($query){
                $query->where('kullanici_id',auth()->id());
            })
            ->orderByDesc('id')->get();
        return view('siparis',compact('siparisler'));
    }
    public function detay($id){
        $urunler = siparisModel::with('sepet.sepet_urunler.urun')
            ->whereHas('sepet',function ($query){
                $query->where('kullanici_id',auth()->id());
            })
            ->where('siparis.id',$id)->firstOrFail();
        return view('siparisDetay',compact('urunler'));
    }
}
