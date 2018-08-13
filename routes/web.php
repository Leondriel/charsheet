<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/char/{id?}', 'CharacterController@edit')->name('character.edit');
Route::post('/char/{id?}', 'CharacterController@save')->name('character.save');
Route::get('/char/delete/{id}', 'CharacterController@delete')->name('character.delete');
Route::put('/spells/{id}', 'SpellController@update');
Route::get('/spells/relation/{rank}', 'SpellController@relation');
Route::post('/spells/saveRelation/{rank}', 'SpellController@updateRelation');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('spells', 'SpellController');
Route::get('/spells/list/{class}', 'SpellController@list');
