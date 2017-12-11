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

Route::group(['middlewareGroups' => 'web'], function () {
    // your routes

    Route::post('investors/verify/email', ['uses' => 'Admin\InvestorController@verifyEmail', 'as' => 'investorsverifyEmail']);
    Route::post('investors/kyc/email', ['uses' => 'Admin\InvestorController@kycEmail', 'as' => 'investorskycEmail']);

	
    Route::get('/', ['middleware' => 'guest', 'uses' => 'HomeController@index', 'as' => 'admin.home']);
    Route::get('admin/login', ['middleware' => 'guest', 'uses' => 'Auth\AuthController@getLogin', 'as' => 'admin.login']);
    Route::post('admin/login', ['uses' => 'Auth\AuthController@postLoginAuth', 'as' => 'admin.login']);
    Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

    // Registration routes...
    Route::get('auth/register', ['middleware' => 'guest', 'uses' => 'Auth\AuthController@getRegister', 'as' => 'auth.register']);
    Route::post('auth/register', ['middleware' => 'guest', 'uses' => 'Auth\AuthController@postRegister', 'as' => 'auth.register']);

    // Password Reset Routes...
    Route::get('password/reset', ['as' => 'auth.forgot.password', 'uses' => 'Auth\PasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin::', 'middleware' => 'admin'], function () {
        
        //Dashboard
        Route::get('dashboard', ['uses' => 'IndexController@index', 'as' => 'dashboard']);
        
        
        //Investors
        Route::get('investors', ['uses' => 'InvestorController@index', 'as' => 'investors']); 
        Route::get('investors.list', ['uses' => 'InvestorController@getInvestorsList', 'as' => 'investorsList']);        
        Route::get('investors/create', ['uses' => 'InvestorController@create', 'as' => 'investorsCreate']);
        Route::post('investors/store', ['uses' => 'InvestorController@store', 'as' => 'investorsStore']);
        Route::get('investors/{id}/edit', ['uses' => 'InvestorController@edit', 'as' => 'investorsEdit']);
        Route::post('investors/update', ['uses' => 'InvestorController@update', 'as' => 'investorsUpdate']);        
        Route::get('investors/{id}/view', ['uses' => 'InvestorController@view', 'as' => 'investorsView']); 
        Route::get('investors/delete/{id}', ['uses' => 'InvestorController@delete', 'as' => 'investorsDelete']);
        
        
        //Investors New
        Route::get('investors-all', ['uses' => 'InvestorNewController@index', 'as' => 'investorsNew']); 
        Route::get('investors-all.list', ['uses' => 'InvestorNewController@getInvestorsList', 'as' => 'investorsNewList']);        
        Route::get('investors-all/create', ['uses' => 'InvestorNewController@create', 'as' => 'investorsNewCreate']);
        Route::post('investors-all/store', ['uses' => 'InvestorNewController@store', 'as' => 'investorsNewStore']);
        Route::get('investors-all/{id}/edit', ['uses' => 'InvestorNewController@edit', 'as' => 'investorsNewEdit', 'middleware' => 'checkinvestorstatus']);
        Route::post('investors-all/update', ['uses' => 'InvestorNewController@update', 'as' => 'investorsNewUpdate']);        
        Route::get('investors-all/{id}/view', ['uses' => 'InvestorNewController@view', 'as' => 'investorsNewView']); 
        Route::get('investors-all/delete/{id}', ['uses' => 'InvestorNewController@delete', 'as' => 'investorsNewDelete']);
        Route::post('investors-all/status/change', ['uses' => 'InvestorNewController@changeStatus', 'as' => 'investorschangeStatus']);
        Route::post('investors-all/flag/update', ['uses' => 'InvestorNewController@InvestorFlagUpdate', 'as' => 'InvestorFlagUpdate']); 
        
        
         //PR Investors New
        Route::get('pr-investors', ['uses' => 'InvestorNewController@prInvestors', 'as' => 'prInvestors']); 
        Route::get('pr-investors.list', ['uses' => 'InvestorNewController@getprInvestorsList', 'as' => 'prInvestorsList']);        
        Route::get('pr-investors/{id}/edit', ['uses' => 'InvestorNewController@prInvestorEdit', 'as' => 'prInvestorEdit', 'middleware' => 'checkinvestorstatus']);
        Route::post('pr-investors/update', ['uses' => 'InvestorNewController@prInvestorUpdate', 'as' => 'prInvestorUpdate']);

        Route::get('wp-investors', ['uses' => 'InvestorNewController@indexWp', 'as' => 'investorsWp']); 
        Route::get('wp-investors.list', ['uses' => 'InvestorNewController@getInvestorsWpList', 'as' => 'investorsWpList']);     
        Route::get('wp-investors/{id}/edit', ['uses' => 'InvestorNewController@editWpInvestor', 'as' => 'investorsWpEdit', 'middleware' => 'checkinvestorstatus']);
        Route::post('wp-investors/update', ['uses' => 'InvestorNewController@investorWpUpdate', 'as' => 'investorsWpUpdate']);

        //Investors New
        Route::get('entries', ['uses' => 'EntriesController@index', 'as' => 'entries']); 
        Route::get('entries.list', ['uses' => 'EntriesController@getEntriesList', 'as' => 'entriesList']);        

        //Settings
        Route::get('settings', ['uses' => 'SettingsController@index', 'as' => 'settings']); 
        Route::get('settings.list', ['uses' => 'SettingsController@getInvestorsList', 'as' => 'settingsList']);        
        Route::get('settings/create', ['uses' => 'SettingsController@create', 'as' => 'settingsCreate']);
        Route::post('settings/store', ['uses' => 'SettingsController@store', 'as' => 'settingsStore']);
        Route::get('settings/{id}/edit', ['uses' => 'SettingsController@edit', 'as' => 'settingsEdit']);
        Route::post('settings/update', ['uses' => 'SettingsController@update', 'as' => 'settingsUpdate']);        
        Route::get('settings/{id}/view', ['uses' => 'SettingsController@view', 'as' => 'settingsView']); 
        Route::post('settings/delete', ['uses' => 'SettingsController@delete', 'as' => 'settingsDelete']);
        Route::any('settings/load-ico-settings', ['uses' => 'SettingsController@loadIcoSettings', 'as' => 'settingsloadIcoSettings']);
        Route::any('settings/get-stats', ['uses' => 'SettingsController@getStats', 'as' => 'settingsgetStats']);
        
        
        //Show Transactions
        Route::get('show-transactions', ['uses' => 'TransactionController@index', 'as' => 'showTransactions']); 
        Route::post('ajax-get-investors', ['as'=>'ajaxGetInvestors', 'uses'=>'TransactionController@ajaxGetInvestors']);
        Route::post('tr-search-form1', ['as'=>'trSearchForm1', 'uses'=>'TransactionController@trSearchForm1']);
        Route::get('tr-search-results', ['as'=>'trSearchResults1', 'uses'=>'TransactionController@trSearchResults1']);
        
        
    });
    
});

