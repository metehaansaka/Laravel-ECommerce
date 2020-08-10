<?php

namespace App\Providers;

use App\Models\kullaniciModel;
use App\Models\siparisModel;
use App\Models\urunModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('yonetim.*',function ($view){
            $bitiszamani = now()->addMinutes(10);
            $istatistikler = Cache::remember('istatistikler',$bitiszamani,function (){
                return [
                    'bekleyen' => siparisModel::where('durum','Sipariş Alındı')->count(),
                    'tamamlanan' => siparisModel::where('durum','Teslim Edildi')->count(),
                    'urun' => urunModel::all()->count(),
                    'kullanici' => kullaniciModel::all()->count()
                ];
            });
            $view->with('istatistikler',$istatistikler);
        });
    }
}
