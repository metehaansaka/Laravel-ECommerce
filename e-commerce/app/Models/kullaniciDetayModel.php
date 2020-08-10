<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kullaniciDetayModel extends Model
{
    protected $table = 'kullanici_detay';
    public $timestamps = false;
    protected $guarded = [];

    public function kullanici(){
        return $this->belongsTo('App/Models/kullaniciModel', 'kullanici_id', 'id');
    }
}
