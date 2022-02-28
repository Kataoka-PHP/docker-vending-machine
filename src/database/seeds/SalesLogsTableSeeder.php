<?php

use Illuminate\Database\Seeder;

class SalesLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'product_id' => 1,
            'purchase_price' => 200,
        ];
        DB::table('sales_logs')->insert($param);
        $param = [
            'product_id' => 2,
            'purchase_price' => 420,
        ];
        DB::table('sales_logs')->insert($param);
        $param = [
            'product_id' => 3,
            'purchase_price' => 3800,
        ];
        DB::table('sales_logs')->insert($param);
    }
}