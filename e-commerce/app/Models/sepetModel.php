<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class sepetModel extends Model
{
    use SoftDeletes;
    protected $table = 'sepet';
    protected $guarded = [];
    const CREATED_AT = "oluşturulma_tarihi";
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function siparis(){
        return $this->hasOne('App\Models\siparisModel');
    }

    public function sepet_urunler(){
        return $this->hasMany('App\Models\sepetUrunModel','sepet_id','id');
    }

    public static function aktif_sepet_id(){
        $aktif_sepet = DB::table('sepet as s')
            ->leftJoin('siparis as si','si.sepet_id','=','s.id')
            ->where('s.kullanici_id',auth()->id())
            ->whereRaw('si.id is null')
            ->orderByDesc('s.oluşturulma_tarihi')
            ->select('s.id')
            ->first();
        if (!is_null($aktif_sepet))
            return $aktif_sepet->id;
    }

    public function sepet_urun_adet(){
        return DB::table('sepet_urun')->where('sepet_id',$this->id)->sum('adet');
    }

    public function kullanici(){
        return $this->belongsTo('App\Models\kullaniciModel','kullanici_id','id');
    }

}
