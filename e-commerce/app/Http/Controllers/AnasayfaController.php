<?php

namespace App\Http\Controllers;

use App\Models\kategoriModel;
use App\Models\urunDetayModel;
use App\Models\urunModel;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function index(){
        $kategoriler = kategoriModel::whereRaw('ust_id is null')->take(8)->get();
        $slider = urunDetayModel::with('urun')->where('slider',1)->take(5)->get();
        $firsat2 = urunDetayModel::with('urun')->where('one_cikan',1)->take(4)->get();
        $firsat = urunModel::select('urun.*')
            ->join('urun_detay','urun_detay.urun_id','urun.id')
            ->where('urun_detay.one_cikan',1)
            ->orderBy('güncelleme_tarihi','desc')
            ->first();
        $cok_satan = urunDetayModel::with('urun')->where('cok_satan',1)->take(4)->get();
        $indirimli = urunDetayModel::with('urun')->where('indirimli',1)->take(4)->get();
        return view('Anasayfa',compact('kategoriler','slider','firsat','firsat2','cok_satan','indirimli'));
    }
}
