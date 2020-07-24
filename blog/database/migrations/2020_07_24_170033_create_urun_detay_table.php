<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrunDetayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urun_detay', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('urun_id')->unique();
            $table->boolean('slider');
            $table->boolean('one_cikan');
            $table->boolean('cok_satan');
            $table->boolean('indirimli');

            $table->foreign('urun_id')->references('id')->on('urun')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urun_detay');
    }
}
