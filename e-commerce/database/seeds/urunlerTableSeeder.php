<?php

use Illuminate\Database\Seeder;

class urunlerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
       \App\Models\urunDetayModel::truncate();
       \App\Models\urunModel::truncate();
       for ($i = 0; $i < 30; $i++){
            $urun_adi = $faker->sentence(2);
            $urun = \App\Models\urunModel::create([
                'urun_adi'=>$urun_adi,
                'slug'=>Str::slug($urun_adi),
                'urun_aciklama'=>$faker->sentence(20),
                'urun_fiyat'=>$faker->randomFloat(3,1,20)
            ]);
            $detay = $urun->detay()->create([
                'slider' => rand(0,1),
                'one_cikan' => rand(0,1),
                'cok_satan' => rand(0,1),
                'indirimli' => rand(0,1)
            ]);
       }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}
