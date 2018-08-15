<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('schools')
            ->insert([
                ['name' => 'Bann'],
                ['name' => 'Beschwörung'],
                ['name' => 'Erkenntnis'],
                ['name' => 'Hervorrufung'],
                ['name' => 'Illusion'],
                ['name' => 'Nekromantie'],
                ['name' => 'Verwandlung'],
                ['name' => 'Verzauberung'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
