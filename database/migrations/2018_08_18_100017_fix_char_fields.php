<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixCharFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('level')->unsigned()->default(0);
            $table->dropForeign(['char_class2_id']);
            $table->dropColumn('char_class2_id');
            $table->dropForeign(['char_class3_id']);
            $table->dropColumn('char_class3_id');


            $table->string('background')->nullable()->change();
            $table->integer('experience')->unsigned()->nullable()->change();

            $table->integer('proficiency_bonus')->nullable()->change();
            //attributes
            $table->integer('strength')->nullable()->change();
            $table->integer('dexterity')->nullable()->change();
            $table->integer('constitution')->nullable()->change();
            $table->integer('intelligence')->nullable()->change();
            $table->integer('wisdom')->nullable()->change();
            $table->integer('charisma')->nullable()->change();
            $table->integer('has_strength_save')->nullable()->change();
            $table->integer('has_dexterity_save')->nullable()->change();
            $table->integer('has_constitution_save')->nullable()->change();
            $table->integer('has_intelligence_save')->nullable()->change();
            $table->integer('has_wisdom_save')->nullable()->change();
            $table->integer('has_charisma_save')->nullable()->change();
            $table->integer('strength_save_bonus')->nullable()->change();
            $table->integer('dexterity_save_bonus')->nullable()->change();
            $table->integer('constitution_save_bonus')->nullable()->change();
            $table->integer('intelligence_save_bonus')->nullable()->change();
            $table->integer('wisdom_save_bonus')->nullable()->change();
            $table->integer('charisma_save_bonus')->nullable()->change();
            //skills
            $table->integer('has_acrobatics')->nullable()->change();
            $table->integer('has_arcane')->nullable()->change();
            $table->integer('has_athletics')->nullable()->change();
            $table->integer('has_performance')->nullable()->change();
            $table->integer('has_intimidation')->nullable()->change();
            $table->integer('has_insight')->nullable()->change();
            $table->integer('has_sleigh_of_hands')->nullable()->change();
            $table->integer('has_medicine')->nullable()->change();
            $table->integer('has_history')->nullable()->change();
            $table->integer('has_nature')->nullable()->change();
            $table->integer('has_religion')->nullable()->change();
            $table->integer('has_persuasion')->nullable()->change();
            $table->integer('has_investigation')->nullable()->change();
            $table->integer('has_deception')->nullable()->change();
            $table->integer('has_animal_handling')->nullable()->change();
            $table->integer('has_perception')->nullable()->change();
            $table->integer('has_survival')->nullable()->change();
            $table->integer('has_stealth')->nullable()->change();
            $table->integer('acrobatics_bonus')->nullable()->change();
            $table->integer('arcane_bonus')->nullable()->change();
            $table->integer('athletics_bonus')->nullable()->change();
            $table->integer('performance_bonus')->nullable()->change();
            $table->integer('intimidation_bonus')->nullable()->change();
            $table->integer('insight_bonus')->nullable()->change();
            $table->integer('sleigh_of_hands_bonus')->nullable()->change();
            $table->integer('medicine_bonus')->nullable()->change();
            $table->integer('history_bonus')->nullable()->change();
            $table->integer('nature_bonus')->nullable()->change();
            $table->integer('religion_bonus')->nullable()->change();
            $table->integer('persuasion_bonus')->nullable()->change();
            $table->integer('investigation_bonus')->nullable()->change();
            $table->integer('deception_bonus')->nullable()->change();
            $table->integer('animal_handling_bonus')->nullable()->change();
            $table->integer('perception_bonus')->nullable()->change();
            $table->integer('survival_bonus')->nullable()->change();
            $table->integer('stealth_bonus')->nullable()->change();

            $table->integer('armor_class')->nullable()->change();
            $table->integer('initiative')->nullable()->change();
            $table->float('movement')->nullable()->change();
            $table->integer('max_hp')->nullable()->change();
            $table->integer('current_hp')->nullable()->change();
            $table->integer('temporary_hp')->nullable()->change();
            $table->integer('hit_die')->nullable()->change();
            $table->integer('current_hit_die')->nullable()->change();
            $table->boolean('inspiration')->nullable()->change();
            $table->integer('death_save_success')->nullable()->change();
            $table->integer('death_save_fail')->nullable()->change();

            $table->text('personality')->nullable()->change();
            $table->text('ideal')->nullable()->change();
            $table->text('connection')->nullable()->change();
            $table->text('weakness')->nullable()->change();

            $table->text('languages')->nullable()->change();
            $table->text('inventory')->nullable()->change();
            $table->integer('copper')->nullable()->change();
            $table->integer('silver')->nullable()->change();
            $table->integer('gold')->nullable()->change();
            $table->integer('electrum')->nullable()->change();
            $table->integer('platinum')->nullable()->change();

            $table->json('attacks')->nullable()->change();

            $table->text('feats')->nullable()->change();

            $table->integer('age')->nullable()->change();
            $table->float('height')->nullable()->change();
            $table->float('weight')->nullable()->change();
            $table->string('eye_color')->nullable()->change();
            $table->string('skin_color')->nullable()->change();
            $table->string('hair_color')->nullable()->change();
            $table->string('deity')->nullable()->change();

            $table->text('background_story')->nullable()->change();
            $table->text('appearance')->nullable()->change();
            $table->text('allies')->nullable()->change();
            $table->text('spells')->nullable()->change();
            $table->string('spell_list')->nullable()->change();
            $table->integer('spell_save_bonus')->nullable()->change();
            $table->integer('spell_attack_bonus')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->integer('char_class2_id')->unsigned();
            $table->foreign('char_class2_id')->references('id')->on('char_classes');
            $table->integer('char_class3_id')->unsigned();
            $table->foreign('char_class3_id')->references('id')->on('char_classes');
        });
    }
}
