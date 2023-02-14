<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->date('sale_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('applicable_categories')->nullable();
            $table->decimal('min_price_range',12,2)->nullable();
            $table->decimal('max_price_range',12,2)->nullable();
            $table->enum('type', ['1','2'])->default('1')->comment('1=today,3= date range');	
            $table->enum('status', ['0','1','3'])->default('1')->comment('0=active,1=active,3=deleted');	

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
