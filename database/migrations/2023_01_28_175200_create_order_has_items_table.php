<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_has_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->foreignId('item_id')->nullable()->constrained('shows');
            $table->integer('quantity')->nullable();
            $table->decimal('item_amount',12,2)->nullable();
            $table->decimal('paid_amount',12,2)->nullable();
            $table->decimal('discount_amount',12,2)->nullable();
            $table->enum('type', ['1','2'])->default('1')->comment('1=instant download,2=cd');
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
        Schema::dropIfExists('order_has_items');
    }
}
