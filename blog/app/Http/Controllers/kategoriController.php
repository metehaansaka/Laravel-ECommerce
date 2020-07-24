<?php

namespace App\Http\Controllers;

use App\Models\kategoriModel;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index($slug){
        $kategori = kategoriModel::where('slug',$slug)->firstOrFail();
        $alt_kategoriler = kategoriModel::where('ust_id',$kategori->id)->get();
        $urunler = $kategori->urun;
        return view('kategori',compact('kategori','alt_kategoriler','urunler'));
    }
}
