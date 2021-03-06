<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','AnasayfaController@index')->name('anasayfa');
Route::get('/kategori/{kategoriAd}','kategoriController@index')->name('kategori');
Route::get('/urun/{urunAd}','urunController@index')->name('urun');
Route::post('/ara','urunController@ara')->name('urun_ara');
Route::get('/ara','urunController@ara')->name('urun_ara');
Route::group(['prefix'=>'sepet'],function (){
    Route::post('/ekle','sepetController@ekle')->name('sepet.ekle');
    Route::get('/','sepetController@index')->name('sepet');
    Route::delete('/kaldir/{id}','sepetController@kaldir')->name('sepet.kaldir');
    Route::delete('/bosalt','sepetController@bosalt')->name('sepet.bosalt');
    Route::patch('/guncelle/{id}','sepetController@guncelle');
});
Route::get('/odeme','odemeController@index')->name('odeme');
Route::post('/odeme','odemeController@odeme')->name('odemeYap');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/siparis','siparisController@index')->name('siparis');
    Route::get('/siparisDetay/{id}','siparisController@detay')->name('siparisDetay');
});
Route::group(['prefix'=>'kullanici'],function (){
    Route::get('/oturumac','kullaniciController@giris')->name('kullanici.oturumac');
    Route::post('/oturumac','kullaniciController@oturumac');
    Route::get('/kaydol','kullaniciController@kaydol_form')->name('kullanici.kaydol');
    Route::post('/kaydol','kullaniciController@kaydol');
    Route::get('/aktiflestir/{aktivasyon}','kullaniciController@aktivasyon')->name('kullanici.aktivasyon');
    Route::post('/cikis','kullaniciController@cikis')->name('kullanici.cikis');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'yonetim']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => 'yonetim' , 'namespace' => 'yonetim'],function (){
    Route::match(['get','post'],'/','kullaniciController@oturumac')->name('yonetim.oturumac');
    Route::get('/oturumkapat','kullaniciController@oturumkapat')->name('yonetim.oturumkapat');
    Route::group(['middleware' => 'yonetim'],function (){
        Route::get('/anasayfa','anasayfaController@index')->name('yonetim.anasayfa');
        Route::group(['prefix' => '/kullanici'],function (){
            Route::match(['post','get'],'/liste','kullaniciController@index')->name('yonetim.kullanici.liste');
            Route::get('/duzenle/{id}','kullaniciController@form')->name('yonetim.kullanici.duzenle');
            Route::get('/yeni','kullaniciController@form')->name('yonetim.kullanici.yeni');
            Route::post('/kaydet{id}','kullaniciController@kaydet')->name('yonetim.kullanici.kaydet');
            Route::get('/sil/{id}','kullaniciController@sil')->name('yonetim.kullanici.sil');
        });
        Route::group(['prefix' => '/kategori'],function (){
            Route::match(['post','get'],'/liste','kategoriController@index')->name('yonetim.kategori.liste');
            Route::get('/duzenle/{id}','kategoriController@form')->name('yonetim.kategori.duzenle');
            Route::get('/yeni','kategoriController@form')->name('yonetim.kategori.yeni');
            Route::post('/kaydet/{id?}','kategoriController@kaydet')->name('yonetim.kategori.kaydet');
            Route::get('/sil/{id}','kategoriController@sil')->name('yonetim.kategori.sil');
        });
        Route::group(['prefix' => '/urun'],function (){
            Route::match(['post','get'],'/liste','urunController@index')->name('yonetim.urun.liste');
            Route::get('/duzenle/{id}','urunController@form')->name('yonetim.urun.duzenle');
            Route::get('/yeni','urunController@form')->name('yonetim.urun.yeni');
            Route::post('/kaydet/{id?}','urunController@kaydet')->name('yonetim.urun.kaydet');
            Route::get('/sil/{id}','urunController@sil')->name('yonetim.urun.sil');
        });
        Route::group(['prefix' => '/siparis'],function (){
            Route::match(['post','get'],'/liste','siparisController@index')->name('yonetim.siparis.liste');
            Route::get('/duzenle/{id}','siparisController@form')->name('yonetim.siparis.duzenle');
            Route::get('/yeni','siparisController@form')->name('yonetim.siparis.yeni');
            Route::post('/kaydet/{id?}','siparisController@kaydet')->name('yonetim.siparis.kaydet');
            Route::get('/sil/{id}','siparisController@sil')->name('yonetim.siparis.sil');
        });
    });
});


