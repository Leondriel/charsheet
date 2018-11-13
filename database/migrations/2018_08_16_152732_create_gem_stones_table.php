<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGemstonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gem_stones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gem_category_id')->unsigned();
            $table->string('name')->nullable()->unique();
            $table->text('description')->nullable();
            $table->integer('cost')->nullable();
            $table->timestamps();
            $table->foreign('gem_category_id')->references('id')->on('gem_categories');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gem_stones');
    }
}
