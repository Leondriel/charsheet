<?php

namespace App\Http\Controllers;

use App\Models\CharClass;
use App\Models\School;
use App\Models\Spell;
use function compact;
use Illuminate\Http\Request;

class SpellController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all()->pluck('name', 'id')->toArray();

        return view('spells.edit', ['schools' => $schools, 'spell' => new Spell()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $spell = new Spell();
        $spell->name = request('name');
        $spell->school_id = request('school_id');
        $spell->rank = request('rank');
        $spell->cast_duration = request('cast_duration');
        $spell->range = request('range');
        $spell->component_voice = request('component_voice');
        $spell->component_gesture = request('component_gesture');
        $spell->component_material = request('component_material');
        $spell->material = request('material');
        $spell->duration = request('duration');
        $spell->description = request('description');
        $spell->save();

        return redirect('/spells/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spell $spell
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Spell $spell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spell $spell
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Spell $spell)
    {
        $schools = School::all()->pluck('name', 'id')->toArray();
        return view('spells.edit', ['schools' => $schools, 'spell' => $spell]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Spell $spell
     *
     * @return \Illuminate\Http\Response
     */
    public function update($spell)
    {
        $spell = Spell::find($spell);
        $spell->name = request('name');
        $spell->school_id = request('school_id');
        $spell->rank = request('rank');
        $spell->cast_duration = request('cast_duration');
        $spell->range = request('range');
        $spell->component_voice = request('component_voice');
        $spell->component_gesture = request('component_gesture');
        $spell->component_material = request('component_material');
        $spell->material = request('material');
        $spell->duration = request('duration');
        $spell->description = request('description');
        $spell->save();

        return redirect('/spells/overview');
    }

    public function relation($rank)
    {
        $spells = Spell::where('rank', $rank)->orderBy('name')->get();

        return view('spells.relation', ['spells' => $spells, 'rank' => $rank]);
    }

    public function updateRelation($rank)
    {
        $relations = request('relations');
        foreach ($relations as $spellId => $rels) {
            $spell = Spell::find($spellId);
            $spell->list_bard = $rels['bard'] ?? false;
            $spell->list_cleric = $rels['cleric'] ?? false;
            $spell->list_druid = $rels['druid'] ?? false;
            $spell->list_paladin = $rels['paladin'] ?? false;
            $spell->list_ranger = $rels['ranger'] ?? false;
            $spell->list_sorcerer = $rels['sorcerer'] ?? false;
            $spell->list_warlock = $rels['warlock'] ?? false;
            $spell->list_wizard = $rels['wizard'] ?? false;
            $spell->save();
        }

        return redirect('/spells/relation/' . $rank);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spell $spell
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spell $spell)
    {
        //
    }

    public function list($class)
    {
        $spells = Spell::where('list_' . $class, 1)->orderBy('rank')->orderBy('name')->get();
        $schools = School::all()->toArray();

        return view('spells.list', ['spells' => $spells, 'schools' => $schools]);
    }

    public function overview() {
        $schoolsSelected = request('schools', []);
        $charClassesSelected = request('classes', []);
        $ranksSelected = request('ranks', []);
        $demoSpell = Spell::first();
        $query = Spell::query();
        if(count($schoolsSelected)) {
            $query->whereIn('school_id', $schoolsSelected);
        }
        if(count($ranksSelected)) {
            $query->whereIn('rank', $ranksSelected);
        }
        if(count($charClassesSelected)) {
            $query->where(function($query) use ($charClassesSelected, $demoSpell) {
                $invalid = true;
                foreach($charClassesSelected as $charClass) {
                    $column = 'list_' . $charClass;
                    if(isset($demoSpell->$column)) {
                        $invalid = false;
                        $query->orWhere($column, 1);
                    }
                }
                if($invalid) {
                    $query->whereRaw('1 = 0');
                }
            });
        }
        $spells = $query->orderBy('name')->pluck('name', 'id');
        $ranks = [0 => 'Zaubertricks'];
        for($i = 1; $i < 10; $i++) {
            $ranks[$i] = $i. '. Grad';
        }

        $charClasses = CharClass::all();
        $schools = School::all();
        return view('spells.overview', compact('spells', 'schools', 'ranks', 'charClasses'));
    }
}
