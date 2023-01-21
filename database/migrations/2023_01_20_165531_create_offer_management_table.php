<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_management', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('applicable_shows')->nullable();
            $table->string('applicable_categories')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('discount_amount',12,2)->nullable();
            $table->enum('type', ['1','2'])->default('1')->comment('1=percentage,2=fixed');	
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
        Schema::dropIfExists('offer_management');
    }
}
