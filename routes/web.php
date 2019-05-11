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

Route::get('auth/{provider}', 'AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
// Admin Routing

Route::group(['middleware' => array('web', 'auth'), 'prefix' => 'admin'], function()
{
    Route::get('', 'HomeController@index')->name('home');
        // Talent
        Route::get('mentor', 'MentorController@index')->name('mentor');
        // Route::post('talent', 'TalentController@tambah')->name('tambah-talent');
        // Route::post('talent/edit', 'TalentController@edit')->name('edit-talent');
        // Route::post('talent/delete', 'TalentController@delete')->name('delete-talent');
        Route::get('semua-data-mentor', 'MentorController@semuaDataMentor')->name('semua-data-mentor');
        // Talent
        Route::get('talent', 'TalentController@index')->name('talent');
        Route::post('talent', 'TalentController@tambah')->name('tambah-talent');
        Route::post('talent/edit', 'TalentController@edit')->name('edit-talent');
        Route::post('talent/delete', 'TalentController@delete')->name('delete-talent');
        Route::get('semua-data-talent', 'TalentController@semuaDataTalent')->name('semua-data-talent');
        // user
        Route::get('users', 'TalentController@index')->name('users');
});

// User


Route::group(['middleware' => array('web', 'auth'), 'prefix' => 'me'], function()
{
    Route::get('/', 'MeController@index')->name('profile');
    Route::post('/register-mentor', 'MeController@registerMentor')->name('register-mentor');
    Route::post('/edit-my-profile', 'MeController@editMyProfile')->name('edit-my-profile');
    Route::post('/create-class', 'MeController@createClass')->name('create-class');
});
