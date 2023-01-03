<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryAndProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_and_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('orginal_file_name')->nullable();
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price',12,2)->nullable();
            $table->integer('quantity')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('parent')->default('0')->comment('0=Parent,1=Sub-category');
            $table->enum('type', ['F','C'])->default('C')->comment('F=File,C=Category');
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
        Schema::dropIfExists('category_and_products');
    }
}
