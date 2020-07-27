<?php

namespace App\Http\Controllers;

use App\Models\urunModel;
use Cart;
use Illuminate\Http\Request;

class sepetController extends Controller
{
    public function index(){
        return view('sepet');
    }

    public function ekle(){
        $urun = urunModel::find(request('id'));
        Cart::add($urun->id,$urun->urun_adi,$urun->urun_fiyat,1,array('slug'=>$urun->slug));

        return redirect()->route('sepet')
            ->with('mesaj','ürün eklendi');
    }
}
