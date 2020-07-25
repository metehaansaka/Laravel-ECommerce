<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class kullaniciModel extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'kullanici';
    protected $guarded = [];
    protected $hidden = ['sifre', 'aktivasyon'];
    const CREATED_AT = "oluşturulma_tarihi";
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
}
