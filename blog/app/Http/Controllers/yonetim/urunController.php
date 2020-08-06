<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;
use App\Models\urunModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class urunController extends Controller
{
    public function index(){
        if (\request()->filled('aranan')){
            \request()->flash();
            $aranan = \request('aranan');
            $kullanicilar = urunModel::where('urun_adi','like',"%$aranan%")
                ->orderByDesc('oluşturulma_tarihi')
                ->paginate(8)
                ->appends('aranan',$aranan);
        }
        else {
            \request()->flush();
            $kullanicilar = urunModel::orderByDesc('oluşturulma_tarihi')->paginate(8);
        }
        return view('yonetim.urun.liste',compact('kullanicilar'));
    }

    public function form($id = 0){
        $kullanici = new urunModel;
        if ($id>0){
            $kullanici = urunModel::find($id);
        }
        return view('yonetim.urun.form',compact('kullanici'));
    }

    public function kaydet($id = 0){

        $data = [
            'urun_adi' => \request('ad'),
            'slug' => \request('slug'),
            'urun_aciklama' => \request('aciklama'),
            'urun_fiyat' => \request('fiyat')
        ];

        $data_detay = \request()->only('slider','one_cikan','cok_satan','indirimli');

        if (!request()->filled('slug')){
            $data['slug'] = Str::slug(request('ad'));
            request()->merge(['slug' => $data['slug']]);
        }
        $this->validate(\request(),[
            'ad' => 'required',
            'slug' => (\request('original_slug') != \request('slug') ? 'unique:urun,slug' : '')
        ]);

        if ($id > 0){
            $kullanici = urunModel::find($id);
            $kullanici->update($data);
            $kullanici->detay()->update($data_detay);
        }else{
            $kullanici = urunModel::create($data);
            $kullanici->detay()->create($data_detay);
        }
        return redirect()->route('yonetim.urun.duzenle',$kullanici->id);
    }

    public function sil($id){
        $kategori = urunModel::find($id);
        $kategori->kategori()->detach();
        $kategori->delete();
        return redirect()->route('yonetim.kategori.liste');
    }
}
