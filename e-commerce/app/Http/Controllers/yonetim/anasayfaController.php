<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;

class anasayfaController extends Controller
{
    public function index(){
        $cok_satan_urunler = \DB::select(
            "SELECT u.urun_adi, sum(su.adet) toplam
                    FROM siparis si
                    INNER JOIN sepet s ON si.sepet_id = s.id
                    INNER JOIN sepet_urun su ON s.id = su.sepet_id
                    INNER JOIN urun u ON su.urun_id = u.id
                    GROUP BY u.urun_adi
                    ORDER BY sum(su.adet) DESC"
        );
        $aylara_gore_satislar = \DB::select(
            "SELECT
                    DATE_FORMAT(si.oluşturulma_tarihi,'%Y-%m') ay, sum(su.adet) toplam
                    FROM siparis si
                    INNER JOIN sepet s on si.sepet_id = s.id
                    INNER JOIN sepet_urun su on s.id = su.sepet_id
                    GROUP BY DATE_FORMAT(si.oluşturulma_tarihi,'%Y-%m')
                    ORDER BY DATE_FORMAT(si.oluşturulma_tarihi, '%Y-%m')"
        );
        return view('yonetim.anasayfa',compact('cok_satan_urunler','aylara_gore_satislar'));
    }
}
