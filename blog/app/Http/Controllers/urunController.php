<?php

namespace App\Http\Controllers;

use App\Models\urunModel;
use Illuminate\Http\Request;

class urunController extends Controller
{
    public function index($slug){
        $urun = urunModel::where('slug',$slug)->firstOrFail();
        $kategoriler = $urun->kategori()->distinct()->get();
        return view('urun',compact('urun','kategoriler'));
    }

    public function ara(){
        $aranan = request()->input('aranan');
        $deger = urunModel::where('urun_adi','like',"%$aranan%")
            ->orWhere('urun_aciklama','like',"%$aranan%")
            ->paginate(2);
        request()->flash();
        return view('ara',compact('deger'));
    }
}
