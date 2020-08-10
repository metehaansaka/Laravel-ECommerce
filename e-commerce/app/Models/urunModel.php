<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class urunModel extends Model
{
    use SoftDeletes;
    protected $table = 'urun';
    protected $guarded = [];
    const CREATED_AT = "oluşturulma_tarihi";
    const UPDATED_AT = "güncelleme_tarihi";
    const DELETED_AT = "silinme_tarihi";
    public function kategori(){
        return $this->belongsToMany('App\Models\kategoriModel','kategori_urun','urun_id','kategori_id');
    }
    public function detay(){
        return $this->hasOne('App\Models\urunDetayModel','urun_id','id')->withDefault();
    }
}
