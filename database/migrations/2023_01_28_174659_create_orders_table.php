<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('order_alt_id')->nullable();
            $table->decimal('oder_amount',12,2)->nullable();
            $table->decimal('paid_amount',12,2)->nullable();
            $table->decimal('discount_amount',12,2)->nullable();
            $table->decimal('shipping_cost',12,2)->nullable();
            $table->enum('type', ['1','2'])->default('1')->comment('1=instant download,2=cd');
            $table->enum('payment_status', ['P','U'])->default('U')->comment('U=Unpaid,P=Paid');
            $table->enum('shipment_status', ['P','C'])->default('P')->comment('P=Pending,C=complete');
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
        Schema::dropIfExists('orders');
    }
}
