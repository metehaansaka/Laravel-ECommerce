<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sepetUrunModel extends Model
{
    use SoftDeletes;
    protected $table = 'sepet_urun';
    protected $guarded = [];
    const CREATED_AT = "oluşturulma_tarihi";
    const UPDATED_AT = 'güncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
}
