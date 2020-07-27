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
});
Route::group(['middleware'=>'auth'],function(){
    Route::get('/odeme','odemeController@index')->name('odeme');
    Route::get('/siparis','siparisController@index')->name('siparis');
    Route::get('/siparis/{id}','siparisController@detay')->name('siparisDetay');
});
Route::group(['prefix'=>'kullanici'],function (){
    Route::get('/oturumac','kullaniciController@giris')->name('kullanici.oturumac');
    Route::post('/oturumac','kullaniciController@oturumac');
    Route::get('/kaydol','kullaniciController@kaydol_form')->name('kullanici.kaydol');
    Route::post('/kaydol','kullaniciController@kaydol');
    Route::get('/aktiflestir/{aktivasyon}','kullaniciController@aktivasyon')->name('kullanici.aktivasyon');
    Route::post('/cikis','kullaniciController@cikis')->name('kullanici.cikis');
});


