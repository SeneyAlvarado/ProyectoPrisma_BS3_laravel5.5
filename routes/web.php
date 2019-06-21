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
/*------------------------------------------------------------------------*/ 
/*------------------------------------------------------------------------*/ 
Route::get('/', function () {  if (Auth::check()) { auth()->logout();}return view('login');});

Route::get('/login', function () {if (Auth::check()) { auth()->logout(); }return view('login');});


Route::post('login', 'Auth\LoginController@login');

Route::get('admin', function () { return view('masterAdmin');});

/*CAMBIO DE CONTRASENNA ROOT */
Route::get('contrasennaAdmin', function() {
    return view('Admin/cambiarContrasenna');
})->middleware('admin');

Route::resource('cambiarContrasennaAdmin', 'ContrasennaRootController');
// Password Reset Routes... no las voy a tocar con middle, no tiene sentido (quizá guest)password.request
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Ni idea de qué carajos es no lo voy a tocar
Auth::routes();
/*FIN CAMBIO DE CONTRASENNA ROOT */
/** -----------------------------------------------------------------------------*/
/** -----------------------------------------------------------------------------*/

/**-----------User routes------------- */
Route::get('user', 'UserController@index')->name('user.index');/**View the accounts list*/
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

/*------------Orders routes------------*/
Route::get('orders', 'OrderController@index')->name('orders');/**View the accounts list*/
Route::get('orders.create', 'OrderController@create')->name('orders.create');/**View the accounts list*/
Route::get('contact.show/{id}', 'ClientController@show')->name('contact.show');
Route::post('orders.store', 'OrderController@store')->name('orders.store');
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


/*------------Load branches, rols, active_states------------*/
Route::get('/branchDrop', 'UserController@ajax_branch');/**Fill the select item with the ACTIVE branches*/
Route::get('/dropRol', 'UserController@ajax_rol');/**Fill the select item with the ACTIVE roles*/
Route::get('/active_states_drop', 'StateController@active_states_drop');/**Fill the select item with the ACTIVE states*/
/*-------------------------------------------*/

Route::get('/branchDrop', 'UserController@ajax_branch');


Route::get('masterRoot', function () {
    return view('masterRoot');
});
/*---------------------------------*/
/*         products-------------*/

//Route::get('productIndex', 'ProductController@index');
//Route::get('productoShow/{id}', 'ProductController@show');
//Route::get('productoEdit/{id}', 'ProductController@edit');
//Route::get('productoCrea', 'ProductController@store');
//Route::get('productoCreate', 'BranchController@list');
//Route::get('productoUpdate', 'BranchController@list2');
//Route::get('productIndex2', function () {
    //return view('products.index');
//});
//Route::resource('products', 'ProductController');
//Route::get('prueba4', function () {
    //return view('masterPrueba4');
//});
/*------------Products----- */
/*------------------------------------------ */


/*------------Products---------------------- */
Route::get('products', 'ProductController@index')->name('products');
Route::get('products.create', 'BranchController@list')->name('products.create');
Route::post('products.store', 'ProductController@store')->name('products.store');
Route::get('products.edit/{id}', 'ProductController@edit')->name('products.edit');
Route::put('products.update/{id}', 'ProductController@update')->name('products.update');
Route::delete('products.deactivate/{id}', 'ProductController@destroy')->name('products.deactivate');
Route::delete('products.activate/{id}', 'ProductController@activate')->name('products.activate');
/*------------------------------------------ */

/**-----------Branch routes------------- */
Route::get('branch', 'BranchController@index')->name('branch');
Route::get('branch.create', 'BranchController@create')->name('branch.create');
Route::post('branch.store', 'BranchController@store')->name('branch.store');
Route::get('branch.edit/{id}', 'BranchController@edit')->name('branch.edit');
Route::post('branch.update', 'BranchController@update')->name('branch.update');
Route::delete('branch.desactivate/{id}', 'BranchController@destroy')->name('branch.desactivate');
Route::delete('branch.activate/{id}', 'BranchController@activate')->name('branch.activate');
/**-------------------------------------------*/

Route::get('/contact.show/{id}', 'ClientController@ajax_contact');

/*----------------------Reports------------------ */
Route::get('reportes', 'ReportController@generate');
/*------------------------------------------------*/

/*---------------------------------Notifications----------------------*/
Route::get('/markReadNotifications', function() {
    auth()->user()->unreadNotifications->markAsRead();
});
Route::get('/getUserNotifications', 'NotificationController@getUserNotifications');
/**************End of notification routes --------------------------- */


/*---------------------------------state_user_types----------------------*/
Route::get('state_user_types', 'State_user_typeController@index')->name('state_user_types');
Route::get('state_user_types.create', 'State_user_typeController@create')->name('state_user_types.create');
Route::post('state_user_types.store', 'State_user_typeController@store')->name('state_user_types.store');
Route::get('state_user_types.edit/{id}', 'State_user_typeController@edit')->name('state_user_types.edit');
Route::post('state_user_types.update/{id}', 'State_user_typeController@update')->name('state_user_types.update');
Route::delete('state_user_types.deactivate/{id}', 'State_user_typeController@destroy')->name('state_user_types.deactivate');
/**************End of state_user_types routes --------------------------- */


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'Auth\LoginController@login')->name('home');

/*----------------------Logout------------------ */
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
/*------------------------------------------------*/

Route::get('/fillnames', 'OrderController@ajax_list_clients');/**Fill the select item with the branches*/