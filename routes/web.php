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

/**-----------User routes------------- */
Route::get('user.index', 'UserController@index')->name('user.index');/**View the accounts list*/
Route::get('user.create', 'UserController@create')->name('user.create');
Route::post('user.store', 'UserController@store')->name('user.store');
Route::get('user.edit/{id}', 'UserController@edit')->name('user.edit');
Route::put('user.update/{id}', 'UserController@update')->name('user.update');
Route::delete('user.desactivate/{id}', 'UserController@destroy')->name('user.desactivate');
Route::delete('user.activate/{id}', 'UserController@activate')->name('user.activate');
/*-------------------------------------------*/

/*------------Admin states routes------------*/
Route::get('estados', 'StateController@index');
Route::get('editarEstados', function () {
    return view('admin/states/edit');
});
Route::get('editarEstados', function () {
    return view('admin/states/edit');
});
Route::get('verEstados', function () {
    return view('admin/states/show');
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
Route::put('actualizarVisita/{id}', 'VisitController@update');
Route::delete('eliminarVisita/{id}', 'VisitController@destroy');
/*-------------------------------------------*/

/* clients */
Route::get('clients', 'ClientController@index')->name('clients');
Route::get('clients.create', 'ClientController@create')->name('clients.create');
Route::post('clients.store', 'ClientController@store')->name('clients.store');
Route::get('clients.edit/{id}', 'ClientController@edit')->name('clients.edit');
Route::post('clients.update/{id}', 'ClientController@update')->name('clients.update');
Route::delete('clients.deactivate/{id}', 'ClientController@destroy')->name('clients.deactivate');
Route::delete('clients.activate/{id}', 'ClientController@activate')->name('clients.activate');
/* end of clients routes */


/*------------Load branches and rols------------*/
Route::get('/branchDrop', 'UserController@ajax_branch');/**Fill the select item with the branches*/
Route::get('/dropRol', 'UserController@ajax_rol');/**Fill the select item with the roles*/
/*-------------------------------------------*/

Route::get('/branchDrop', 'UserController@ajax_branch');


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



Route::get('pruebaM', function () {
    return view('prueba');
});


/*------------Products----- */
/*------------------------------------------ */

/**-----------Branch routes------------- */
Route::get('branch.index', 'BranchController@index')->name('branch.index');
Route::get('branch.create', 'BranchController@create')->name('branch.create');
Route::post('branch.store', 'BranchController@store')->name('branch.store');
Route::get('branch.edit/{id}', 'BranchController@edit')->name('branch.edit');
Route::post('branch.update', 'BranchController@update')->name('branch.update');
Route::delete('branch.desactivate/{id}', 'BranchController@destroy')->name('branch.desactivate');
Route::delete('branch.activate/{id}', 'BranchController@activate')->name('branch.activate');
/*-------------------------------------------*/


/*----------------------Reports------------------ */
Route::get('reportes', 'ReportController@generate');
/*------------------------------------------------*/