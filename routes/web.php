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

Auth::routes();

Route::get('/', 'PageController@index');

Route::resource('tournaments', 'TournamentController');


/*
 *  api - ajax
 */
Route::get('/api/postcode/{postcode}','Api\LocationController@show');
Route::get('/api/tournaments','Api\TounamentController@all');
Route::post('/api/tournaments','Api\TounamentController@filtert');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api/user/{id}', function ($id){

    $u = \App\Models\Users\User::find($id);
    return new \App\Http\Resources\User($u);

});