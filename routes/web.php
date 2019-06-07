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
    if(Auth::check()) {
        auth()->logout();
    }
    return view('login');
});

Route::get('/login', function () {
    if(Auth::check()) {
        auth()->logout();
    }
    return view('login');
});


Route::post('login', 'Auth\LoginController@login');
    


Route::get('admin', function () {
    return view('masterAdmin');
    //return view('products/index');
});

Route::get('recepcion', function () {
    return view('masterReception');
});

Route::get('postProduccion', function () {
    return view('masterPostProduction');
});

Route::get('print', function () {
    return view('masterPrint');
});


/*------------Admin states routes------------*/
Route::get('estados', 'StateController@index');

Route::get('editarEstados', function() {
    return view('states/edit');
});

Route::get('verEstados', function() {
    return view('states/show');
});

Route::get('crearEstados', 'StateController@create');
Route::get('guardarEstado', 'StateController@store');
/*-------------------------------------------*/

Route::get('admin_clients_index', 'ClientController@index');

Route::resource('clients', 'ClientController');

Route::get('prueba3', function () {
    return view('masterPrueba3');
});

/**Routes for admin account */
Route::get('admin_accounts_index', 'UserController@index');

Route::get('/branchDrop', 'UserController@ajax_branch');

Route::post('createUser', 'UserController@store');

Route::get('admin_accounts_create', function () {
    return view('admin.accounts.create') ;
})->name('create_account_admin');