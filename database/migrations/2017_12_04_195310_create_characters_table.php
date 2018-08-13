<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->integer('race_id')->unsigned();
            $table->foreign('race_id')->references('id')->on('races');
            $table->integer('char_class_id')->unsigned();
            $table->foreign('char_class_id')->references('id')->on('char_classes');
            $table->integer('char_class2_id')->unsigned();
            $table->foreign('char_class2_id')->references('id')->on('char_classes');
            $table->integer('char_class3_id')->unsigned();
            $table->foreign('char_class3_id')->references('id')->on('char_classes');
            $table->string('background');
            $table->integer('alignment_id')->unsigned();
            $table->foreign('alignment_id')->references('id')->on('alignments');
            $table->integer('experience')->unsigned();

            $table->integer('proficiency_bonus');
            //attributes
            $table->integer('strength');
            $table->integer('dexterity');
            $table->integer('constitution');
            $table->integer('intelligence');
            $table->integer('wisdom');
            $table->integer('charisma');
            $table->integer('has_strength_save');
            $table->integer('has_dexterity_save');
            $table->integer('has_constitution_save');
            $table->integer('has_intelligence_save');
            $table->integer('has_wisdom_save');
            $table->integer('has_charisma_save');
            $table->integer('strength_save_bonus');
            $table->integer('dexterity_save_bonus');
            $table->integer('constitution_save_bonus');
            $table->integer('intelligence_save_bonus');
            $table->integer('wisdom_save_bonus');
            $table->integer('charisma_save_bonus');
            //skills
            $table->integer('has_acrobatics');
            $table->integer('has_arcane');
            $table->integer('has_athletics');
            $table->integer('has_performance');
            $table->integer('has_intimidation');
            $table->integer('has_insight');
            $table->integer('has_sleigh_of_hands');
            $table->integer('has_medicine');
            $table->integer('has_history');
            $table->integer('has_nature');
            $table->integer('has_religion');
            $table->integer('has_persuasion');
            $table->integer('has_investigation');
            $table->integer('has_deception');
            $table->integer('has_animal_handling');
            $table->integer('has_perception');
            $table->integer('has_survival');
            $table->integer('has_stealth');
            $table->integer('acrobatics_bonus');
            $table->integer('arcane_bonus');
            $table->integer('athletics_bonus');
            $table->integer('performance_bonus');
            $table->integer('intimidation_bonus');
            $table->integer('insight_bonus');
            $table->integer('sleigh_of_hands_bonus');
            $table->integer('medicine_bonus');
            $table->integer('history_bonus');
            $table->integer('nature_bonus');
            $table->integer('religion_bonus');
            $table->integer('persuasion_bonus');
            $table->integer('investigation_bonus');
            $table->integer('deception_bonus');
            $table->integer('animal_handling_bonus');
            $table->integer('perception_bonus');
            $table->integer('survival_bonus');
            $table->integer('stealth_bonus');

            $table->integer('armor_class');
            $table->integer('initiative');
            $table->float('movement');
            $table->integer('max_hp');
            $table->integer('current_hp');
            $table->integer('temporary_hp');
            $table->integer('hit_die');
            $table->integer('current_hit_die');
            $table->boolean('inspiration');
            $table->integer('death_save_success');
            $table->integer('death_save_fail');

            $table->text('personality');
            $table->text('ideal');
            $table->text('connection');
            $table->text('weakness');

            $table->text('languages');
            $table->text('inventory');
            $table->integer('copper');
            $table->integer('silver');
            $table->integer('gold');
            $table->integer('electrum');
            $table->integer('platinum');

            $table->json('attacks');

            $table->text('feats');

            $table->integer('age');
            $table->float('height');
            $table->float('weight');
            $table->string('eye_color');
            $table->string('skin_color');
            $table->string('hair_color');
            $table->string('deity');

            $table->text('background_story');
            $table->text('appearance');
            $table->text('allies');
            $table->text('spells');
            $table->string('spell_list');
            $table->integer('spell_save_bonus');
            $table->integer('spell_attack_bonus');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
