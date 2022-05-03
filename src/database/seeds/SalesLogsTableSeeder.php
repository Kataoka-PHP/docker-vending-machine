<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'product_master_id' => 1,
            'purchase_price' => 200,
            'purchase_time' => Carbon::now(),
        ];
        DB::table('sales_logs')->insert($param);
        $param = [
            'product_master_id' => 2,
            'purchase_price' => 420,
            'purchase_time' => Carbon::now(),
        ];
        DB::table('sales_logs')->insert($param);
        $param = [
            'product_master_id' => 3,
            'purchase_price' => 3800,
            'purchase_time' => Carbon::now(),
        ];
        DB::table('sales_logs')->insert($param);
    }
}