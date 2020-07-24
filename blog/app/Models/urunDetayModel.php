<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class urunDetayModel extends Model
{
    protected $table = 'urun_detay';
    public $timestamps = false;

    public function urun(){
        return $this->belongsTo('App\Models\urunModel');
    }
}
