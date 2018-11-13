<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        \Illuminate\Support\Facades\DB::table('users')
            ->insert([
                [
                    'name' => 'test',
                    'email' => 'test@test.de',
                    'password' => '$2y$10$dkLYcfahxHYfFZ4fQ6G5euaslIexB9.dts5K2GVLvme1A0AxtzXQ6', // test123
                ],
            ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
