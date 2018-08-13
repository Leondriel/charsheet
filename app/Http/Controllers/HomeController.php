<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $characters = Character::where('user_id', auth()->user()->id)->select('name', 'id')->get()->toArray();
        return view('home', [
            'characters' => $characters,
            'user' => auth()->user()
        ]);
    }
}
