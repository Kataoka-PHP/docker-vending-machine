<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameProductIdToProductMasterIdOnSalesLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_logs', function (Blueprint $table) {
            $table->renameColumn('product_id', 'product_master_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_logs', function (Blueprint $table) {
            $table->renameColumn('product_master_id', 'product_id');
        });
    }
}
