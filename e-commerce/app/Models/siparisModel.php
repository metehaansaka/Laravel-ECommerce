<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class siparisModel extends Model
{
    use SoftDeletes;
    protected $table = 'siparis';
    protected $fillable = ['sepet_id','durum','banka','taksit_sayisi','fiyat'];
    const CREATED_AT = "oluşturulma_tarihi";
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function sepet(){
        return $this->belongsTo('App\Models\sepetModel','sepet_id','id');
    }
}
