<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alignments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('alignments')
            ->insert([
                ['name' => 'Rechtschaffen Gut'],
                ['name' => 'Neutral Gut'],
                ['name' => 'Chaotisch Gut'],
                ['name' => 'Rechtschaffen Neutral'],
                ['name' => 'Neutral'],
                ['name' => 'Chaotisch Neutral'],
                ['name' => 'Rechtschaffen Böse'],
                ['name' => 'Neutral Böse'],
                ['name' => 'Chaotisch Böse']
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alignments');
    }
}
