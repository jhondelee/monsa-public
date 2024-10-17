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

    Route::get('printDraft/{id}', 'SalesController@printDraft')->name("salesorder.printDraft"); 

    Route::get('print/{id}', 'SalesController@printSO')->name("salesorder.print"); 

    Route::get('cancel/{id}', 'SalesController@cancel')->name("salesorder.cancel");

    Route::get('post/{id}', 'SalesController@post')->name("salesorder.post"); 

    Route::get('deduct/{id}', 'SalesController@deduct')->name("salesorder.deduct");   

    Route::post('getcustomeritems', 'SalesController@getcustomeritems')->name("salesorder.getcustomeritems");

    Route::post('getforsoitems', 'SalesController@getForSOitems')->name("salesorder.getforsoitems");

    Route::post('additem', 'SalesController@getInventoryItems')->name("salesorder.getInventoryItems");



});

    

