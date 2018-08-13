<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('char_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('char_classes')
            ->insert([
                ['name' => 'Barbar'],
                ['name' => 'Barde'],
                ['name' => 'Druide'],
                ['name' => 'Hexenmeister'],
                ['name' => 'Kämpfer'],
                ['name' => 'Kleriker'],
                ['name' => 'Magier'],
                ['name' => 'Mönch'],
                ['name' => 'Paladin'],
                ['name' => 'Schurke'],
                ['name' => 'Waldläufer'],
                ['name' => 'Zauberer']
                ]
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('char_classes');
    }
}
