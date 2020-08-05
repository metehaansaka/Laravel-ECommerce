<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;
use App\Models\kategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class kategoriController extends Controller
{
    public function index(){
        if (\request()->filled('aranan')){
            \request()->flash();
            $aranan = \request('aranan');
            $kullanicilar = kategoriModel::where('kategori_adi','like',"%$aranan%")
                ->orderByDesc('oluşturulma_tarihi')
                ->paginate(8)
                ->appends('aranan',$aranan);
        }
        else {
            $kullanicilar = kategoriModel::orderByDesc('oluşturulma_tarihi')->paginate(8);
        }
        return view('yonetim.kategori.liste',compact('kullanicilar'));
    }

    public function form($id = 0){
        $kullanici = new kategoriModel;
        if ($id>0){
            $kullanici = kategoriModel::find($id);
        }
        $kategoriler = kategoriModel::all();
        return view('yonetim.kategori.form',compact('kullanici','kategoriler'));
    }

    public function kaydet($id = 0){

        $data = [
            'kategori_adi' => \request('kategori_adi'),
            'slug' => \request('slug'),
            'ust_id' => \request('ust_id')
        ];

        if (!request()->filled('slug')){
            $data['slug'] = Str::slug(request('kategori_adi'));
            request()->merge(['slug' => $data['slug']]);
        }
        $this->validate(\request(),[
            'kategori_adi' => 'required',
            'slug' => (\request('original_slug') != \request('slug') ? 'unique:kategori,slug' : '')
        ]);

        if ($id > 0){
            $kullanici = kategoriModel::find($id);
            $kullanici->update($data);
        }else{
            $kullanici = kategoriModel::create($data);
        }
        return redirect()->route('yonetim.kategori.liste');
    }

    public function sil($id){
        $kategori = kategoriModel::find($id);
        $kategori->urun()->detach();
        $kategori->delete();
        return redirect()->route('yonetim.kategori.liste');
    }
}
