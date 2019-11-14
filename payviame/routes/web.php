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

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/pricing', 'HomeController@pricing')->name('pricing');

/*
|--------------------------------------------------------------------------
| Web Routes For Frontend
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'auth', 'namespace'=>'Frontend'], function (){

    // Report 
    Route::get('/dashboard', 'ReportController@index')->name('report.index');
    Route::get('/memberships', 'ReportController@membership')->name('report.membership');
    Route::get('/dashboard/{id}/change_lang/{slug}', ['uses' => 'ReportController@changeLang', 'as' => 'report.changeLang']);
    
    // Setting
    Route::get('/setting/profile/{id}', ['uses' => 'SettingController@profile_index', 'as' => 'setting.profile.index']);
    Route::put('/setting/profile_update/{id}', ['uses' => 'SettingController@profile_update', 'as' => 'setting.profile.update']);
    Route::get('/setting/password', ['uses' => 'SettingController@password_index', 'as' => 'setting.password.index']);
    Route::put('/setting/password_update', ['uses' => 'SettingController@password_update', 'as' => 'setting.password.update']);
    Route::get('/setting/business', ['uses' => 'SettingController@business_detail', 'as' => 'setting.business.detail']);
    Route::put('/setting/business_detail_update/{id}', ['uses' => 'SettingController@business_detail_update', 'as' => 'setting.business.update']);
    Route::get('/setting/default', ['uses' => 'SettingController@default_index', 'as' => 'setting.default.index']);
    Route::put('/setting/default_update/{id}', ['uses' => 'SettingController@defaul_update', 'as' => 'setting.default.update']);
    Route::post('/setting/tax_store', ['uses' => 'SettingController@tax_store', 'as' => 'setting.tax.store']);
    Route::post('/setting/tax_update', ['uses' => 'SettingController@tax_update', 'as' => 'setting.tax.update']);
    Route::delete('/setting/tax_destroy/{id}', ['uses' => 'SettingController@tax_destroy', 'as' => 'setting.tax.destroy']);
    Route::get('/setting/inventory', ['uses' => 'SettingController@inventory_index', 'as' => 'setting.inventory.index']);
    Route::post('/setting/inventory_store', ['uses' => 'SettingController@inventory_store', 'as' => 'setting.inventory.store']);
    Route::post('/setting/inventory_update', ['uses' => 'SettingController@inventory_update', 'as' => 'setting.inventory.update']);
    Route::delete('/setting/inventory_destroy/{id}', ['uses' => 'SettingController@inventory_destroy', 'as' => 'setting.account.inventory_destroy']);
    Route::delete('/setting/destroy/{id}', ['uses' => 'SettingController@destroy', 'as' => 'setting.account.destroy']);
    Route::get('/setting/performence', ['uses' => 'SettingController@performence_index', 'as' => 'setting.performence.index']);
    Route::put('/setting/performence_update/{id}', ['uses' => 'SettingController@performence_update', 'as' => 'setting.performence.update']);
    
    // Client
    Route::get('/clients', ['uses' => 'ClientController@index', 'as' => 'client.index']);
    Route::get('/clients/archived', ['uses' => 'ClientController@archived', 'as' => 'client.archived']);
    Route::put('/clients/archived/{id}', ['uses' => 'ClientController@archived_update', 'as' => 'client.archived.update']);
    Route::put('/clients/unarchived/{id}', ['uses' => 'ClientController@unarchived_update', 'as' => 'client.unarchived.update']);
    Route::post('/clients/store/{slug}', ['uses' => 'ClientController@store', 'as' => 'client.store']);
    Route::get('/clients/{id}', ['uses' => 'ClientController@show', 'as' => 'client.show']);
    Route::get('/clients/{id}/edit', ['uses' => 'ClientController@edit', 'as' => 'client.edit']);
    Route::put('/clients/update/{id}', ['uses' => 'ClientController@update', 'as' => 'client.update']);
    Route::delete('/clients/destroy/{id}', ['uses' => 'ClientController@destroy', 'as' => 'client.destroy']);

    // Team
    Route::get('/teams', ['uses' => 'TeamController@index', 'as' => 'team.index']);
    Route::get('/teams/create', ['uses' => 'TeamController@create', 'as' => 'team.create']);
    Route::post('/teams/store', ['uses' => 'TeamController@store', 'as' => 'team.store']);
    Route::get('/teams/{id}/change_permission/{slug}', ['uses' => 'TeamController@changePermission', 'as' => 'team.changePermission']);

    // Quote
    Route::get('/quotes', ['uses' => 'QuoteController@index', 'as' => 'quote.index']);
    // Route::get('/{id}/quotes/{slug}', ['uses' => 'QuoteController@index', 'as' => 'quote.filter']);
    Route::get('/quotes/create/{id}', ['uses' => 'QuoteController@create', 'as' => 'quote.create']);
    Route::post('/quotes/store', ['uses' => 'QuoteController@store', 'as' => 'quote.store']);
    Route::get('/quotes/{id}', ['uses' => 'QuoteController@show', 'as' => 'quote.show']);
    Route::get('/quotes/edit/{id}', ['uses' => 'QuoteController@edit', 'as' => 'quote.edit']);
    Route::post('/quotes/update', ['uses' => 'QuoteController@update', 'as' => 'quote.update']);
    Route::delete('/quotes/destroy/{id}', ['uses' => 'QuoteController@destroy', 'as' => 'quote.destroy']);
    Route::get('/quotes/download-pdf/{id}', ['uses' => 'QuoteController@downloadPDF', 'as' => 'quote.download_pdf']);
    Route::post('/quotes/generate-pdf', ['uses' => 'QuoteController@generatePDF', 'as' => 'quote.generate_pdf']);
    Route::get('/quotes/print/{id}', ['uses' => 'QuoteController@print_preview', 'as' => 'quote.print_preview']);
    Route::get('/quotes/duplicate/{id}', ['uses' => 'QuoteController@duplicate_quote', 'as' => 'quote.duplicate_quote']);
    Route::post('/quotes/send/{id}', ['uses' => 'QuoteController@send', 'as' => 'quote.send']);
    Route::get('/quotes/{id}/status/{slug}', ['uses' => 'QuoteController@status_update', 'as' => 'quote.status.update']);

    // Invoice
    Route::get('/invoices', ['uses' => 'InvoiceController@index', 'as' => 'invoice.index']);
    Route::get('/invoices/new/{id}', ['uses' => 'InvoiceController@new', 'as' => 'quote.new']);
    Route::get('/invoices/{id}/create/{slug}', ['uses' => 'InvoiceController@create', 'as' => 'invoice.create']);
    Route::post('/invoices/store', ['uses' => 'InvoiceController@store', 'as' => 'invoice.store']);
    Route::get('/invoices/{id}', ['uses' => 'InvoiceController@show', 'as' => 'invoice.show']);
    Route::get('/invoices/edit/{id}', ['uses' => 'InvoiceController@edit', 'as' => 'invoice.edit']);
    Route::post('/invoices/update', ['uses' => 'InvoiceController@update', 'as' => 'invoice.update']);
    Route::delete('/invoices/destroy/{id}', ['uses' => 'InvoiceController@destroy', 'as' => 'invoice.destroy']);
    Route::get('/invoices/download-pdf/{id}', ['uses' => 'InvoiceController@downloadPDF', 'as' => 'invoice.download_pdf']);
    Route::post('/invoices/generate-pdf', ['uses' => 'InvoiceController@generatePDF', 'as' => 'invoice.generate_pdf']);
    Route::get('/invoices/print/{id}', ['uses' => 'InvoiceController@print_preview', 'as' => 'invoice.print_preview']);
    Route::get('/invoices/print/{id}', ['uses' => 'InvoiceController@print_preview', 'as' => 'invoice.print_preview']);
    Route::get('/invoices/duplicate/{id}', ['uses' => 'InvoiceController@duplicate_invoice', 'as' => 'invoice.duplicate_invoice']);
    Route::post('/invoices/send/{id}', ['uses' => 'InvoiceController@send', 'as' => 'invoice.send']);
    Route::get('/invoices/{id}/status/{slug}', ['uses' => 'InvoiceController@status_update', 'as' => 'invoice.status.update']);
    Route::post('invoices/record/store', ['uses' => 'InvoiceController@record_store', 'as' => 'invoice.record.save']);

});


/*
|--------------------------------------------------------------------------
| Web Routes For Admin
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'admin', 'middleware'=>'admin', 'namespace'=>'Backend'], function (){
    
    Route::get('', ['uses' => 'DashboardController@index', 'as' => 'admin.dashboard']);

    // Language management
    Route::get('{id}/change_lang/{slug}', ['uses' => 'DashboardController@changeLang','as' => 'admin.changeLang']);
    Route::get('lang/{slug}', ['uses' => 'LangController@index', 'as' => 'admin.lang.index']);
    Route::get('lang/create/{slug}', ['uses' => 'LangController@create', 'as' => 'admin.lang.create']);
    Route::post('lang/store', ['uses' => 'LangController@store', 'as' => 'admin.lang.store']);
    Route::post('lang/update/{slug}', ['uses' => 'LangController@update', 'as' => 'admin.lang.update']);

    // User management
    Route::get('user', ['uses' => 'UserController@index', 'as' => 'admin.user.index']);
    Route::get('user/create', ['uses' => 'UserController@create', 'as' => 'admin.user.create']);
    Route::post('user/store', ['uses' => 'UserController@store', 'as' => 'admin.user.store']);
    Route::get('user/{id}', ['uses' => 'UserController@show', 'as' => 'admin.user.show']);
    Route::get('user/{id}/edit', ['uses' => 'UserController@edit', 'as' => 'admin.user.edit']);
    Route::put('user/update/{id}', ['uses' => 'UserController@update', 'as' => 'admin.user.update']);
    Route::delete('user/{id}/destroy', ['uses' => 'UserController@destroy', 'as' => 'admin.user.destroy']);

    // Currency management
    Route::get('currency', ['uses' => 'CurrencyController@index', 'as' => 'admin.currency.index']);
    Route::get('currency/create', ['uses' => 'CurrencyController@create', 'as' => 'admin.currency.create']);
    Route::post('currency/store', ['uses' => 'CurrencyController@store', 'as' => 'admin.currency.store']);
    Route::get('currency/{id}', ['uses' => 'CurrencyController@show', 'as' => 'admin.currency.show']);
    Route::get('currency/{id}/edit', ['uses' => 'CurrencyController@edit', 'as' => 'admin.currency.edit']);
    Route::put('currency/update/{id}', ['uses' => 'CurrencyController@update', 'as' => 'admin.currency.update']);
    Route::delete('currency/{id}/destroy', ['uses' => 'CurrencyController@destroy', 'as' => 'admin.currency.destroy']);

    // Quote management
    Route::get('quote', ['uses' => 'QuoteController@index', 'as' => 'admin.quote.index']);
    Route::get('quote/{id}/{slug}', ['uses' => 'QuoteController@index', 'as' => 'admin.quote.filter']);

    // Invoice management
    Route::get('invoice', ['uses' => 'InvoiceController@index', 'as' => 'admin.invoice.index']);
    Route::get('invoice/{id}/{slug}', ['uses' => 'InvoiceController@index', 'as' => 'admin.invoice.filter']);
});
