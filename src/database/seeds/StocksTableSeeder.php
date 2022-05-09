<?php

use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'product_master_id' => 1,
            'stock' => 2,
        ];
        DB::table('stocks')->insert($param);
        $param = [
            'product_master_id' => 2,
            'stock' => 3,
        ];
        DB::table('stocks')->insert($param);
        $param = [
            'product_master_id' => 3,
            'stock' => 4,
        ];
        DB::table('stocks')->insert($param);
    }
}