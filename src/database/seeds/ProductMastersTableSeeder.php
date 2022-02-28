<?php

use Illuminate\Database\Seeder;

class ProductMastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'product_name' => 'コーラ',
            'image' => base64_encode(Storage::get('cola.jpg')),
            'price' => 100,
            'display_order' => 1,
        ];
        DB::table('product_masters')->insert($param);
        $param = [
            'product_name' => 'ビール',
            'image' => base64_encode(Storage::get('beer.jpg')),
            'price' => 210,
            'display_order' => 2,
        ];
        DB::table('product_masters')->insert($param);
        $param = [
            'product_name' => '食パン',
            'image' => base64_encode(Storage::get('plain_blead.jpg')),
            'price' => 1900,
            'display_order' => 3,
        ];
        DB::table('product_masters')->insert($param);
    }
}
