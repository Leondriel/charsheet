<?php

namespace App\Http\Controllers;

use App\Models\GemCategory;
use App\Models\GemStone;
use function compact;
use Illuminate\Http\Request;

class GemController extends Controller
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
        $gem_categories = GemCategory::all()->pluck('name', 'id')->toArray();

        return view('gems.edit', ['gem_categories' => $gem_categories, 'gem' => new GemStone()]);
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
        $gem = new GemStone();
        $gem->name = request('name');
        $gem->gem_category_id = request('gem_category_id');
        $gem->cost = request('cost');
        $gem->description = request('description');
        $gem->save();

        return redirect('/gems/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gem $gem
     *
     * @return \Illuminate\Http\Response
     */
    public function show(GemStone $gem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gem $gem
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(GemStone $gem)
    {
        $gem_categories = GemCategory::all()->pluck('name', 'id')->toArray();
        return view('gems.edit', ['gem_categories' => $gem_categories, 'gem' => $gem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Gem $gem
     *
     * @return \Illuminate\Http\Response
     */
    public function update($gem)
    {
        $gem = GemStone::find($gem);
        $gem->name = request('name');
        $gem->gem_category_id = request('gem_category_id');
        $gem->cost = request('cost');
        $gem->description = request('description');
        $gem->save();

        return redirect('/gems/overview');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gem $gem
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gem $gem)
    {
        //
    }

    public function overview() {
        $gem_categorySelected = request('categories', []);
        $query = Gemstone::query();
        if(count($gem_categorySelected)) {
            $query->whereIn('gem_category_id', $gem_categorySelected);
        }
        $gems = $query->orderBy('name')->pluck('name', 'id');

        $gem_categories = GemCategory::all();
        return view('gems.overview', compact('gems', 'gem_categories'));
    }
}
