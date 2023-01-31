<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOderHasAdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oder_has_adresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('street_address')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('zip_code',100)->nullable();
            $table->string('city',100)->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('state_id')->nullable()->constrained('states');
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
        Schema::dropIfExists('oder_has_adresses');
    }
}
