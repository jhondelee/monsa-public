<?php

/*
|--------------------------------------------------------------------------
| Sales Management
|--------------------------------------------------------------------------

*/
// Sales
Route::group(['prefix' => 'sales'], function() {    

    Route::get('/', 'SalesController@index')->name("salesorder.index");

    Route::get('add', 'SalesController@create')->name("salesorder.create");

    Route::post('add', 'SalesController@store')->name("salesorder.store");

    Route::get('edit/{id}', 'SalesController@edit')->name("salesorder.edit");  

    Route::post('edit', 'SalesController@update')->name("salesorder.update"); 
    
    Route::get('delete/{id}', 'SalesController@destroy')->name("salesorder.delete");    
});


