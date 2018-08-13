<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('races')
            ->insert([
                ['name' => 'Elf'],
                ['name' => 'Halbling'],
                ['name' => 'Mensch'],
                ['name' => 'Zwerg'],
                ['name' => 'Drachenblütiger'],
                ['name' => 'Gnom'],
                ['name' => 'Halbelf'],
                ['name' => 'Halbork'],
                ['name' => 'Tiefling']
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races');
    }
}
