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

Route::get('/','AnasayfaController@index');
Route::get('/kategori/{kategoriAd}','kategoriController@index')->name('kategori');
Route::get('/urun/{urunAd}','urunController@index')->name('urun');
Route::post('/ara','urunController@ara')->name('urun_ara');
Route::get('/sepet','sepetController@index')->name('sepet');
Route::get('/odeme','odemeController@index')->name('odeme');
Route::get('/siparis','siparisController@index')->name('siparis');
Route::get('/siparis/{id}','siparisController@detay')->name('siparisDetay');
Route::group(['prefix'=>'kullanici'],function (){
    Route::get('/oturumac','kullaniciController@giris')->name('kullanici.oturumac');
    Route::get('/kaydol','kullaniciController@kaydol')->name('kullanici.kaydol');
});


