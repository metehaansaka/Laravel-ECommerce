<?php

namespace App\Http\Controllers;

use App\kullaniciModel;
use App\Mail\kullaniciMail;
use App\Models\kullaniciDetayModel;
use App\Models\sepetModel;
use App\Models\sepetUrunModel;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class kullaniciController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('cikis');
    }

    public function giris(){
        return view('kullanici.oturumac');
    }

    public function oturumac(){
        if (auth()->attempt(['mail'=>request('email'),'password'=>request('sifre')],request()->has('benihatirla'))){
            request()->session()->regenerate();

            $aktif_sepet_id = sepetModel::aktif_sepet_id();
            if (is_null($aktif_sepet_id)){
                $aktif_sepet = sepetModel::create(['kullanici_id' => auth()->id()]);
                $aktif_sepet_id = $aktif_sepet->id;
            }
            session()->put('aktif_sepet_id',$aktif_sepet_id);

            if (Cart::getContent()->count()){
                foreach (Cart::getContent() as $cartItem){
                    sepetUrunModel::updateOrCreate(
                        ['urun_id' => $cartItem->id, 'sepet_id' => $aktif_sepet_id],
                        ['adet' => $cartItem->quantity, 'fiyat' => $cartItem->price, 'durum' => 'Beklemede']
                    );
                }
            }

            Cart::clear();

            $urunler = sepetUrunModel::where('sepet_id',$aktif_sepet_id)->get();

            foreach ($urunler as $urun){
                Cart::add($urun->urun_id,$urun->urun->urun_adi,$urun->fiyat,$urun->adet,array('slug'=>$urun->urun->slug));
            }

            return redirect()->intended('/');
        }else{
            $errors = ['email' => 'Hatalı Giriş'];
            return back()->with($errors);
        }
    }

    public function kaydol_form(){
        return view('kullanici.kaydol');
    }

    public function kaydol(){
        $this->validate(request(),[
            'ad_soyad' => 'required|min:5|max:50',
            'mail' => 'mail|unique:kullanici',
            'sifre' => 'required|confirmed|min:5|max:50'
        ]);
        $kullanici = kullaniciModel::create([
            'ad_soyad' => request('ad_soyad'),
            'mail' => request('email'),
            'sifre' => Hash::make(request('sifre')),
            'aktivasyon' => Str::random(60),
            'aktif' => 0
        ]);
        $kullaniciDetay = $kullanici->kullaniciDetay()->save(new kullaniciDetayModel());
        Mail::to(request('email'))->send(new kullaniciMail($kullanici));
        auth()->login($kullanici);
        return redirect()->route('anasayfa');
    }

    public function cikis(){
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasayfa');
    }

    public function aktivasyon($aktivasyon){
            $kullanici = kullaniciModel::where('aktivasyon',$aktivasyon)->first();
            if (!is_null($kullanici)){
                $kullanici->aktivasyon = null;
                $kullanici->aktif = 1;
                $kullanici->save();
                return redirect()->to('/')->with('mesaj','Hesabınız Onaylanmıştır');
            }
        }
}
