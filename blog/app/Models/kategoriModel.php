<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategoriModel extends Model
{
    use SoftDeletes;
    protected $table = "kategori";
    protected $guarded = [];
    const CREATED_AT = "oluşturulma_tarihi";
    const UPDATED_AT = "güncelleme_tarihi";
    const DELETED_AT = "silinme_tarihi";
    public function urun(){
        return $this->belongsToMany('App\Models\urunModel','kategori_urun','kategori_id','urun_id');
    }
}
