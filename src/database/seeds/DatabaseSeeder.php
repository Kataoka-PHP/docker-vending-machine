<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductMasterTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(SalesLogTableSeeder::class);
    }
}
