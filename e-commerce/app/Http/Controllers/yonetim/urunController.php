<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;
use App\Models\kategoriModel;
use App\Models\urunDetayModel;
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
        $kategori_list = [];
        if ($id>0){
            $kullanici = urunModel::find($id);
            $kategori_list = $kullanici->kategori()->pluck('kategori_id')->all();
        }
        $kategoriler = kategoriModel::all();
        return view('yonetim.urun.form',compact('kullanici','kategori_list','kategoriler'));
    }

    public function kaydet($id = 0){

        $data = [
            'urun_adi' => \request('ad'),
            'slug' => \request('slug'),
            'urun_aciklama' => \request('aciklama'),
            'urun_fiyat' => \request('fiyat')
        ];

        $data_detay = \request()->only('slider','one_cikan','cok_satan','indirimli');

        $kategoriler = \request('kategoriler');

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
            $kullanici->kategori()->sync($kategoriler);
        }else{
            $kullanici = urunModel::create($data);
            $kullanici->detay()->create($data_detay);
            $kullanici->kategori()->attach($kategoriler);
        }

        if(\request()->hasFile('urun_resmi')){
            $this->validate(\request(),[
                'urun_resmi' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);
            $urun_resmi = \request()->file('urun_resmi');
            $resim_adi = $urun_resmi->hashName();
            if ($urun_resmi->isValid()){
                $urun_resmi->move('uploads/urunler',$resim_adi);

                urunDetayModel::updateOrCreate(
                    ['urun_id' => $kullanici->id],
                    ['urun_resmi' => $resim_adi]
                );
            }
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
