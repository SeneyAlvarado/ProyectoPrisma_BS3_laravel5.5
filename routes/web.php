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
Route::get('/', function () {  if (Auth::check()) { auth()->logout();}return view('login2');});

Route::get('/login', function () {if (Auth::check()) { auth()->logout(); }return view('login2');});


/*-------------------------------Auth-----------------------------------------*/ 
Route::get('/', function () {  if (Auth::check()) { auth()->logout();}return view('login2');});
Route::get('/login', function () {if (Auth::check()) { auth()->logout(); }return view('login2');});
Route::post('login', 'Auth\LoginController@login');
Route::get('admin', function () { return view('masterAdmin');});
Route::get('contrasennaAdmin', function() { return view('Admin/cambiarContrasenna');})->middleware('admin');
Route::resource('cambiarContrasennaAdmin', 'ContrasennaRootController');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Auth::routes();
/** -----------------------------Auth------------------------------------------------*/











/* --- ADMIN USER ROUTES  --- --- ADMIN USER ROUTES  --- --- ADMIN USER ROUTES  --- --- ADMIN USER ROUTES  --- */
Route::middleware(['AdminUser'])->group(function () {
    
    /**----------------------------User routes------------------------------------------- */
    Route::get('user', 'UserController@index')->name('user.index');/**View the accounts list*/
    Route::get('user.create', 'UserController@create')->name('user.create');
    Route::post('user.store', 'UserController@store')->name('user.store');
    Route::get('user.edit/{id}', 'UserController@edit')->name('user.edit');
    Route::put('user.update/{id}', 'UserController@update')->name('user.update');
    Route::delete('user.desactivate/{id}', 'UserController@destroy')->name('user.desactivate');
    Route::delete('user.activate/{id}', 'UserController@activate')->name('user.activate');
    /**----------------------------User routes------------------------------------------- */

    /*------------Admin states routes------------*/
    Route::get('states', 'StateController@index');
    Route::get('editState', function () {
        return view('admin/states/edit');
    });
    Route::get('editState', function () {
        return view('admin/states/edit');
    });
    Route::get('showStates', function () {
        return view('admin/states/show');
    });
    Route::get('states.create', 'StateController@create');
    //Route::get('showStates', 'StateController@show');
    Route::get('editState/{id}', 'StateController@edit');
    Route::put('updateState/{id}', 'StateController@update');
    Route::delete('deactivateState/{id}', 'StateController@deactivate');
    Route::delete('activateState/{id}', 'StateController@activate');
    Route::post('saveState', 'StateController@store');
    /*-------------------------------------------*/

    /*------------Products---------------------- */
    Route::get('products', 'ProductController@index')->name('products');
    Route::get('products.create', 'BranchController@list')->name('products.create');
    Route::post('products.store', 'ProductController@store')->name('products.store');
    Route::get('products.edit/{id}', 'ProductController@edit')->name('products.edit');
    Route::put('products.update/{id}', 'ProductController@update')->name('products.update');
    Route::delete('products.deactivate/{id}', 'ProductController@destroy')->name('products.deactivate');
    Route::delete('products.activate/{id}', 'ProductController@activate')->name('products.activate');
    /*--------------------END PRODUCT ADMIN ROUTES -----------------------*/


    /**---------------------------------------------------------- */
    Route::get('materials', 'MaterialController@index')->name('materials');
    Route::get('materials.create', 'BranchController@listMaterial')->name('material.create');
    Route::post('materials.store', 'MaterialController@store')->name('materials.store');
    Route::put('materials.update/{id}', 'MaterialController@update')->name('materials.update');
    Route::get('materials.edit/{id}', 'MaterialController@edit')->name('materials.edit');
    Route::delete('materials.deactivate/{id}', 'MaterialController@destroy')->name('materials.deactivate');
    Route::delete('materials.activate/{id}', 'MaterialController@activate')->name('materials.activate');
    /**---------------------------------------------------------- */

    /**-----------Branch routes------------- */
    Route::get('branch', 'BranchController@index')->name('branch');
    //Route::get('branch.create', 'BranchController@create')->name('branch.create');
    Route::post('branch.store', 'BranchController@store')->name('branch.store');
    //Route::get('branch.edit/{id}', 'BranchController@edit')->name('branch.edit');
    Route::post('branch.update', 'BranchController@update')->name('branch.update');
    Route::delete('branch.desactivate/{id}', 'BranchController@destroy')->name('branch.desactivate');
    Route::delete('branch.activate/{id}', 'BranchController@activate')->name('branch.activate');
    /**-------------------------------------------*/


    /*----------------------Reports------------------ */
    Route::get('reportes', 'ReportController@generate');
    Route::get('reportOrder/{id}', 'OrderController@selectOrder');
    Route::get('reportWorkLog/{id}', 'WorkController@reportWorkLog');
    Route::post('products.chart', 'WorkController@products_chart')->name('products.chart');
    Route::get('products.chart', 'WorkController@products_chart_get')->name('products.chart');
    Route::post('materials.chart', 'WorkController@materials_chart')->name('materials.chart');
    Route::get('materials.chart', 'WorkController@materials_chart_get')->name('materials.chart');
    /*------------------------------------------------*/

    /*---------------------------------state_user_types----------------------*/
    Route::get('state_user_types', 'State_user_typeController@index')->name('state_user_types');
    Route::get('state_user_types.create', 'State_user_typeController@create')->name('state_user_types.create');
    Route::post('state_user_types.store', 'State_user_typeController@store')->name('state_user_types.store');
    Route::get('state_user_types.edit/{id}', 'State_user_typeController@edit')->name('state_user_types.edit');
    Route::post('state_user_types.update/{id}', 'State_user_typeController@update')->name('state_user_types.update');
    Route::delete('state_user_types.deactivate/{id}', 'State_user_typeController@destroy')->name('state_user_types.deactivate');
    /**************End of state_user_types routes --------------------------- */


}); /** --- END ADMIN USER ROUTES  --- --- END ADMIN USER ROUTES  --- --- END ADMIN USER ROUTES  --- */











/* --- Admin_Reception ROUTES  --- --- Admin_Reception ROUTES  --- --- Admin_Reception ROUTES  --- --- Admin_Reception ROUTES  --- */
Route::middleware(['Admin_Reception'])->group(function () {
    
    /** Order routes just for admin and reception */
    Route::get('orders.create', 'OrderController@create')->name('orders.create');/**View the accounts list*/
    /** end order routes just for admin and reception */

    /* clients */
    Route::get('clients', 'ClientController@index')->name('clients');
    Route::get('clients.create', 'ClientController@create')->name('clients.create');
    Route::post('clients.store', 'ClientController@store')->name('clients.store');
    Route::get('clients.edit/{id}', 'ClientController@edit')->name('clients.edit');
    Route::post('clients.update/{id}', 'ClientController@update')->name('clients.update');
    Route::delete('clients.deactivate/{id}', 'ClientController@destroy')->name('clients.deactivate');
    Route::delete('clients.activate/{id}', 'ClientController@activate')->name('clients.activate');
    /* end of clients routes */


}); /** --- END Admin_Reception ROUTES  --- --- END Admin_Reception ROUTES  --- --- END Admin_Reception ROUTES  --- */











/* --- AllUsers ROUTES  --- --- AllUsers ROUTES  --- --- AllUsers ROUTES  --- --- AllUsers ROUTES  --- */
Route::middleware(['AllUsers'])->group(function () {
    
    /*------------Orders routes for all users------------*/
    Route::get('orders', 'OrderController@index')->name('orders');/**View the accounts list*/
    Route::get('contact.show/{id}', 'ClientController@show')->name('contact.show');
    Route::post('orders.store', 'OrderController@store')->name('orders.store');
    Route::get('orders.edit/{id}', 'OrderController@edit')->name('orders.edit');
    Route::get('orders.works/{id}', 'WorkController@orderWorks')->name('orders.works');
    Route::get('/fillnames', 'OrderController@ajax_list_clients');/**Fill the select item with the branches*/
    Route::get('/fillmaterials', 'OrderController@ajax_list_materials');/**Fill the select item with the branches*/
    Route::get('/fillClientContacts/{id}', 'OrderController@ajax_fill_contacts');/**Fill the select item with the branches*/
    Route::post('/addOrdersWorks', 'OrderController@addOrdersWorks');/**Add the JSON of orders and works to the DB*/
    Route::get('/changeOrderWorksState/{orderID}/{stateID}', 'OrderController@changeOrderWorksState');/**Change the state of the order and the works of that order*/
    Route::get('downloadFile/{id}', 'OrderController@downloadFile')->name('downloadFile');/**View the accounts list*/ 
    /*--------------------End order routes for all users ----------------------*/

    /*------------Works routes for Allusers------------*/
    Route::get('trabajos', 'WorkController@index');
    Route::get('/changeWorkState/{workID}/{stateID}', 'WorkController@changeWorkState');
    Route::get('/changeDesigner/{workID}/{designerID}/{designerName}', 'WorkController@changeDesignerWork');/**Change the designer of a work*/ 
    Route::post('/addFileWork', 'WorkController@addFileWork');/**Add the JSON of orders and works to the DB*/
    Route::get('/changeDryingHours/{workID}/{drying_hours}', 'WorkController@changeDryingHours');//changes the drying hours for a work
    /*---------------END WORK ROUTES FOR ALL USERS----------------------*/

    /*------------Load branches, rols, active_states------------*/
    Route::get('/branchDrop', 'UserController@ajax_branch');/**Fill the select item with the ACTIVE branches*/
    Route::get('/dropRol', 'UserController@ajax_rol');/**Fill the select item with the ACTIVE roles*/
    Route::get('/active_states_drop', 'StateController@active_states_drop');/**Fill the select item with the ACTIVE states*/
    /*-------------------------------------------*/

    /*------------Products load branch---------------------- */
    Route::get('active_products_branch', 'ProductController@active_products_branch');
    /*------------------------------------------ */

    Route::get('/contact.show/{id}', 'ClientController@ajax_contact');

    /*---------------------------------Notifications----------------------*/
    Route::get('/markReadNotifications', function() {
        auth()->user()->unreadNotifications->markAsRead();//marks ALL notifications as read
    });
    Route::get('/getUserNotifications', 'NotificationController@getUserNotifications');//gets all user notifications
    Route::get('/readNotification/{notification_id}/{work_id}', 'NotificationController@readNotification');//reads and deletes from DB an specific notification
    Route::get('/deleteNotifications/{idArray}', 'NotificationController@deleteNotifications');//reads and deletes from DB an specific notification
    /**************End of notification routes --------------------------- */

    /*----------------------Logout------------------ */
    //Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    /*------------------------------------------------*/

    /* Client contacts routes */
    Route::resource('client_contacts', 'Client_contactController');
    Route::get('client_contacts.index/{id}', 'Client_contactController@index')->name('client_contacts.index');
    Route::get('client_contacts.create/{id}', 'Client_contactController@create')->name('client_contacts.create');
    Route::get('client_contacts.store/{owner_id}/{contact_id}', 'Client_contactController@store')->name('client_contacts.store');
    Route::get('/fillcontacts/{id}', 'Client_contactController@create');/**Fill the the list of clients*/
    Route::get('/insertContact/{id_owner}/{contact_id}', 'Client_contactController@store');/**Create a new contact of a client*/
    Route::get('/deleteContact/{contact_id}', 'Client_contactController@destroy');/**Fill the select item with the branches*/
    /* End of client contacts routes */

    /* Other routes that were not at a specific group */
    Route::resource('works', 'WorkController');
    Route::get('/dolarExchangeRate', 'CoinController@dolarExchangeRate');/**Gets the dolar exchange rate from BCCR*/
    Route::get('/work.show/{id}', 'WorkController@show');
    /* End other routes that were not a a specific group */

    /*------------Visit routes------------*/
    Route::get('visits', 'VisitController@index');
    Route::get('visits.create', 'VisitController@create');
    Route::post('saveVisit', 'VisitController@store');
    Route::get('editVisit/{id}', 'VisitController@edit');
    Route::put('updateVisit/{id}', 'VisitController@update');
    Route::delete('deleteVisit/{id}', 'VisitController@destroy');
    Route::delete('visits.solve/{id}', 'VisitController@solve')->name('visits.solve');
    /*----------------End visit routes ---------------------------*/

}); /** --- END AllUsers ROUTES  --- --- END AllUsers ROUTES  --- --- END AllUsers ROUTES  --- */









Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'Auth\LoginController@login')->name('home');



/*----------------------Change Password------------------ */
Route::resource('change_password', 'ChanngePasswordController');
Route::get('change_password.search_user', 'ChanngePasswordController@search_user')->name('change_password.search_user');
Route::get('change_password/admin', function () {return view('admin.password.change_password');})->name('password_admin');
/*------------------------------------------------*/









