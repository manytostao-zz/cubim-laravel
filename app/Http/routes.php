<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'MainController@home']);

Route::get('/503', ['as' => 'error.503', function () {
    return view('errors.503');
}]);

#region customers

Route::post('customers/datatable/', ['as' => 'customers.datatable', 'uses' => 'CustomerController@datatable']);

Route::post('customers/filter/', ['as' => 'customers.filter', 'uses' => 'CustomerController@filter']);

Route::post('customers/clean/', ['as' => 'customers.clean', 'uses' => 'CustomerController@clean']);

Route::post('customers/ban/', ['as' => 'customers.ban', 'uses' => 'CustomerController@ban']);

Route::post('customers/activate/', ['as' => 'customers.activate', 'uses' => 'CustomerController@activate']);

Route::post('customers/lastLibraryCardNumber/', ['as' => 'customers.lastLibraryCardNumber', 'uses' => 'CustomerController@lastLibraryCardNumber']);

Route::resource('customers', 'CustomerController');

#endregion

#region nomenclators

Route::post('nomenclators/json/', ['as' => 'nomenclators.json', 'uses' => 'NomenclatorController@json']);

Route::post('nomenclators/datatable/', ['as' => 'nomenclators.datatable', 'uses' => 'NomenclatorController@datatable']);

Route::post('nomenclators/activate/', ['as' => 'nomenclators.activate', 'uses' => 'NomenclatorController@activate']);

Route::resource('nomenclators', 'NomenclatorController');

Route::get('nomenclators/type/{nomenclator_type_id}', ['as' => 'nomenclators.index', 'uses' => 'NomenclatorController@index']);

#endregion

#region users

Route::post('users/json/', ['as' => 'users.json', 'uses' => 'UserController@json']);

Route::post('users/datatable/', ['as' => 'users.datatable', 'uses' => 'UserController@datatable']);

Route::post('users/filter/', ['as' => 'users.filter', 'uses' => 'UserController@filter']);

Route::post('users/clean/', ['as' => 'users.clean', 'uses' => 'UserController@clean']);

Route::resource('users', 'UserController');

#endregion

#region traces

Route::post('traces/datatable/', ['as' => 'traces.datatable', 'uses' => 'TraceController@datatable']);

Route::post('traces/filter/', ['as' => 'traces.filter', 'uses' => 'TraceController@filter']);

Route::get('traces/index/', ['as' => 'traces.index', 'uses' => 'TraceController@index']);

#endregion

#region auth

Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);

Route::post('/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);

Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);
#endregion