<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spells', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable()->unique();
            $table->integer('school_id')->nullable();
            $table->tinyInteger('rank')->nullable();
            $table->string('cast_duration', 255)->nullable();
            $table->string('range', 100)->nullable();
            $table->boolean('component_voice')->nullable();
            $table->boolean('component_gesture')->nullable();
            $table->boolean('component_material')->nullable();
            $table->string('material', 255)->nullable();
            $table->string('duration', 100)->nullable();
            $table->boolean('list_bard')->nullable();
            $table->boolean('list_cleric')->nullable();
            $table->boolean('list_druid')->nullable();
            $table->boolean('list_paladin')->nullable();
            $table->boolean('list_ranger')->nullable();
            $table->boolean('list_sorcerer')->nullable();
            $table->boolean('list_warlock')->nullable();
            $table->boolean('list_wizard')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('school_id')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spells');
    }
}
