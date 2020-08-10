<?php

namespace App\Http\Controllers;

use App\Models\kategoriModel;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index($slug){
        $kategori = kategoriModel::where('slug',$slug)->firstOrFail();
        $alt_kategoriler = kategoriModel::where('ust_id',$kategori->id)->get();
        $order = request('order');
        if ($order=='cok_satanlar'){
            $urunler = $kategori->urun()
                ->distinct()
                ->join('urun_detay','urun_detay.urun_id','urun.id')
                ->orderByDesc('urun_detay.cok_satan')
                ->paginate(2);
        }elseif ($order=='yeni_urunler'){
            $urunler = $kategori->urun()
                ->distinct()
                ->orderByDesc('güncelleme_tarihi')
                ->paginate(2);
        }
        else {
            $urunler = $kategori->urun()->distinct()->paginate(2);
        }
        return view('kategori',compact('kategori','alt_kategoriler','urunler'));
    }
}
