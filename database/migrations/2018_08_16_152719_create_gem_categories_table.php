<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gem_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->unique();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('gem_categories')
            ->insert([
                ['name' => 'Zierstein'],
                ['name' => 'Halbedelstein'],
                ['name' => 'Schmuckstein'],
                ['name' => 'Edelstein'],
                ['name' => 'Juwel'],
            ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gem_categories');
    }
}
