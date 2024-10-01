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

    Route::post('edit/{id}', 'SalesController@update')->name("salesorder.update"); 

    Route::get('delete/{id}', 'SalesController@destroy')->name("salesorder.delete");    

    Route::get('print/{id}', 'SalesController@print')->name("salesorder.print"); 

    Route::get('cancel/{id}', 'SalesController@cancel')->name("salesorder.cancel");

    Route::get('post/{id}', 'SalesController@post')->name("salesorder.post");   

    Route::post('getcustomeritems', 'SalesController@getcustomeritems')->name("salesorder.getcustomeritems");

    Route::post('getpoitems', 'SalesController@getPOitems')->name("salesorder.getpoitems");

    Route::post('supplieritems', 'SalesController@supplierItems')->name("salesorder.supplieritems");

    Route::post('additemSupplier', 'SalesController@additemSupplier')->name("salesorder.additemSupplier");

    Route::post('additem', 'SalesController@getInventoryItems')->name("salesorder.getInventoryItems");  

});

    

