<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSepetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kullanici_id');
            $table->timestamp('oluşturulma_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('güncelleme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('silinme_tarihi')->nullable();
            $table->foreign('kullanici_id')->references('id')->on('kullanici')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sepet');
    }
}
