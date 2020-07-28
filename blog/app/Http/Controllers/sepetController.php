<?php

namespace App\Http\Controllers;

use App\Models\sepetModel;
use App\Models\sepetUrunModel;
use App\Models\urunModel;
use Cart;
use Illuminate\Http\Request;
use Validator;

class sepetController extends Controller
{
    public function index(){
        return view('sepet');
    }

    public function ekle(){
        $urun = urunModel::find(request('id'));
        $cart = Cart::add($urun->id,$urun->urun_adi,$urun->urun_fiyat,1,array('slug'=>$urun->slug));
        if(auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
            if (!isset($aktif_sepet_id)){
                $aktif_sepet = sepetModel::create([
                    'kullanici_id' => auth()->id()
                ]);
                $aktif_sepet_id = $aktif_sepet->id;
                session()->put('aktif_sepet_id',$aktif_sepet_id);
            }
            foreach ($cart->getContent() as $cartItem) {
                sepetUrunModel::updateOrCreate(
                    ['sepet_id' => $aktif_sepet_id, 'urun_id' => $urun->id],
                    ['adet' => $cartItem->quantity, 'fiyat' => $cartItem->price, 'durum' => 'beklemede']
                );
            }
        }

        return redirect()->route('sepet')
            ->with('mesaj','ürün eklendi');
    }

    public function kaldir($id){
        if (auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
            sepetUrunModel::where('sepet_id',$aktif_sepet_id)->where('urun_id',$id)->delete();
        }

        Cart::remove($id);
        return redirect()->route('sepet');
    }

    public function bosalt(){
        if (auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
            sepetUrunModel::where('sepet_id',$aktif_sepet_id)->delete();
        }
        Cart::clear();
        return redirect()->route('sepet');
    }

    public function guncelle($id){
        $validator = Validator::make(request()->all(),[
            'adet' => 'required|between:0,5'
        ]);
        if ($validator->fails()){
            session()->flash('mesaj','Güncellenemedi');
        }else{
            $adet = sepetUrunModel::where('sepet_id',session('aktif_sepet_id'))
                ->where('urun_id',$id)->first();
            if (request('adet') == -1 && $adet->adet == 1)
                sepetUrunModel::where('sepet_id',session('aktif_sepet_id'))
                    ->where('urun_id',$id)
                    ->update(['adet' => 1]);
            else {
                $adet = $adet->adet + request('adet');
                sepetUrunModel::where('sepet_id', session('aktif_sepet_id'))
                    ->where('urun_id', $id)
                    ->update(['adet' => $adet]);
            }
            Cart::update($id,array('quantity' => request('adet')));
            return response()->json(['success'=>true]);
        }
    }
}
