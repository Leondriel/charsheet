<?php

namespace App\Http\Controllers;

use App\Models\Alignment;
use App\Models\Character;
use App\Models\CharClass;
use App\Models\Race;
use App\Models\School;
use App\Models\Spell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CharacterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param null $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id = null)
    {
        $character = null;
        if ($id) {
            $character = Character::find($id);
            $character->spells = json_decode($character->spells);
            $character->attacks = json_decode($character->attacks);
        } else {
            $character = new Character();
        }
        $fields = Schema::getColumnListing($character->getTable());
        $fields = array_fill_keys($fields, null);
        $c = array_merge($fields, $character->attributesToArray());

        $classes = CharClass::all()->toArray();
        $alignments = Alignment::all()->toArray();
        $schools = School::all()->toArray();
        $races = Race::all()->toArray();
        $blankSpells = [
            0 => [],
            1 => [],
            2 => [],
            3 => [],
            4 => [],
            5 => [],
            6 => [],
            7 => [],
            8 => [],
            9 => [],
        ];

        $spellClasses = ['bard', 'cleric', 'druid', 'paladin', 'ranger', 'sorcerer', 'warlock', 'wizard'];
        $spells = [];
        foreach ($spellClasses as $class) {
            $spells[$class] = $blankSpells;
        }

        Spell::all()->each(function ($spell) use (&$spells, $spellClasses) {
            $spell = $spell->toArray();

            foreach ($spellClasses as $class) {
                if ($spell['list_' . $class]) {
                    $spells[$class][$spell['rank']][] = $spell;
                }
            }
        });

        return view('char', [
            'c'          => $c,
            'user'       => auth()->user(),
            'classes'    => $classes,
            'alignments' => $alignments,
            'races'      => $races,
            'schools'    => $schools,
            'spells'     => $spells,
        ]);
    }

    public function save()
    {
        $char = request('c');
        $char['user_id'] = auth()->user()->id;
        $char['attacks'] = json_encode($char['attacks']);
        $char['spells'] = json_encode($char['spells']);
        if (!$char['id']) {
            $c = new Character($char);
            $c->save();

            return $c->id;
        } else {
            $c = Character::find($char['id']);
            if ($c->user_id == auth()->user()->id) {
                Character::where('id', $char['id'])->update($char);
            }

            return $char['id'];
        }
    }

    public function delete($id)
    {
        $char = Character::find($id);
        if ($char->user_id === auth()->user()->id) {
            $char->delete();
        }

        return redirect('/home');
    }
}
