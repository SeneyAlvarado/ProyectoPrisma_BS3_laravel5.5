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
    if (Auth::check()) {
        auth()->logout();
    }
    return view('login');
});

Route::get('/login', function () {
    if (Auth::check()) {
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
Route::get('editarEstados', function () {
    return view('states/edit');
});
Route::get('verEstados', function () {
    return view('states/show');
});
Route::get('crearEstados', 'StateController@create');
Route::get('verEstados', 'StateController@show');
Route::get('editarEstados/{id}', 'StateController@edit');
Route::put('actualizarEstados/{id}', 'StateController@update');
Route::delete('eliminarEstados/{id}', 'StateController@destroy');
Route::post('guardarEstado', 'StateController@store');
/*-------------------------------------------*/

/*------------Admin orders routes------------*/

/*-------------------------------------------*/

/*------------Works routes------------*/
Route::get('trabajos', 'WorkController@index');
/*-------------------------------------------*/

/*------------Visit routes------------*/
Route::get('visitas', 'VisitController@index');
Route::get('crearVisita', 'VisitController@create');
Route::post('guardarVisita', 'VisitController@store');
Route::get('editarVisita/{id}', 'VisitController@edit');
Route::delete('eliminarVisita/{id}', 'VisitController@destroy');
/*-------------------------------------------*/

/* clients */
Route::get('clients', 'ClientController@index')->name('clients');
Route::get('clients.create', 'ClientController@create')->name('clients.create');
Route::post('clients.store', 'ClientController@store')->name('clients.store');
Route::get('clients.edit/{id}', 'ClientController@edit')->name('clients.edit');
Route::get('clients.update/{id}', 'ClientController@store')->name('clients.update');
Route::delete('clients.deactivate/{id}', 'ClientController@destroy')->name('clients.deactivate');
Route::delete('clients.activate/{id}', 'ClientController@activate')->name('clients.activate');

/* end of clients routes */

Route::get('prueba3', function () {
    return view('masterPrueba3');
});

/**Routes for admin account */
Route::get('admin_accounts_index', 'UserController@index')->name('admin_accounts_index');/**View the accounts list*/

Route::get('/branchDrop', 'UserController@ajax_branch');/**Fill the select item with the branches*/

Route::get('/dropRol', 'UserController@ajax_rol');/**Fill the select item with the roles*/

Route::post('createUser', 'UserController@store');

Route::get('admin_accounts_create', function () {
    return view('admin.accounts.create');
})->name('create_account_admin');

Route::get('admin_accounts_edit', function () {
    return view('admin.accounts.edit') ;
})->name('admin_accounts_edit');

Route::get('admin_edit_accounts/{id}', 'UserController@edit')->name('admin_edit_accounts');
Route::put('admin_update_accounts/{id}', 'UserController@update')->name('admin_update_accounts');
Route::delete('admin_desactivate_accounts/{id}', 'UserController@destroy')->name('admin_desactivate_accounts');
Route::delete('admin_activate_accounts/{id}', 'UserController@activate')->name('admin_activate_accounts');

Route::resource('admin_accounts', 'UserController');
/**End admin routes */

Route::get('admin_accounts_create', function () {
    return view('admin.accounts.create');
})->name('create_account_admin');


Route::get('/branchDrop', 'UserController@ajax_branch');



Route::get('prueba1', function () {
    return view('masterPrueba');
});

Route::get('prueba2', function () {
    return view('masterPrueba2');
});

Route::get('prueba3', function () {
    return view('masterPrueba3');
});

Route::get('masterRoot', function () {
    return view('masterRoot');
});
/*---------------------------------*/
/*         products-------------*/


Route::get('productIndex', 'ProductController@index');

Route::get('productoShow/{id}', 'ProductController@show');
Route::get('productoEdit/{id}', 'ProductController@edit');
Route::get('productoCrea', 'ProductController@store');
Route::get('productoCreate', 'BranchController@list');
Route::get('productoUpdate', 'BranchController@list2');


Route::get('productIndex2', function () {
    return view('products.index');
});
Route::resource('products', 'ProductController');


Route::get('prueba4', function () {
    return view('masterPrueba4');
});
/*------------Products----- */
/*------------------------------------------ */
