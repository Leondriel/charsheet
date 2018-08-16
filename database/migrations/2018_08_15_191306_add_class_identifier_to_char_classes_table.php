<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassIdentifierToCharClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('char_classes', function (Blueprint $table) {
            $table->string('identifier', 20);
        });
        $identifiers = [
            'Barbar' => 'barbar',
            'Barde' => 'bard',
            'Druide' => 'druid',
            'Hexenmeister' => 'warlock',
            'Kämpfer' => 'fighter',
            'Kleriker' => 'cleric',
            'Magier' => 'wizard',
            'Mönch' => 'monk',
            'Paladin' => 'paladin',
            'Schurke' => 'rogue',
            'Waldläufer' => 'ranger',
            'Zauberer' => 'sorcerer'
        ];
        foreach($identifiers as $name => $identifier) {
            \Illuminate\Support\Facades\DB::table('char_classes')
                ->where('name', $name)
                ->update(['identifier' => $identifier]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('char_classes', function (Blueprint $table) {
            $table->dropColumn('identifier');
        });
    }
}
