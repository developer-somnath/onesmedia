<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->integer('no_of_episodes')->nullable();
            $table->integer('no_of_mp3_cds')->nullable();
            $table->decimal('instant_download_price',12,2)->nullable();
            $table->decimal('mp3_cd_price',12,2)->nullable();
            $table->string('sample_file_original_name')->nullable();
            $table->string('sample_file')->nullable();
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
        Schema::dropIfExists('shows');
    }
}
