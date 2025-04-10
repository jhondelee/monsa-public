<?php

/*
|--------------------------------------------------------------------------
| Customer Management
|--------------------------------------------------------------------------

*/
// Cusomer
Route::group(['prefix' => 'customer'], function() {    

    Route::get('/', 'CustomerController@index')->name("customer.index");

    Route::get('add', 'CustomerController@create')->name("customer.create");

    Route::post('add', 'CustomerController@store')->name("customer.store");

    Route::get('edit/{id}', 'CustomerController@edit')->name("customer.edit"); 

    Route::post('edit/{id}', 'CustomerController@update')->name("customer.update"); 

    Route::get('delete/{id}', 'CustomerController@destroy')->name("customer.delete"); 

    Route::post('area', 'CustomerController@getAdditionalAreaValue')->name("customer.area");
    
    Route::post('price', 'CustomerController@getCustomerItemSrp')->name("customer.price");  

    Route::post('all-items', 'CustomerController@getAddAllItems')->name("customer.all_items");  

    Route::post('selected-items', 'CustomerController@getSelectedItems')->name("customer.selected_items");  

    Route::post('cost-items', 'CustomerController@getItemCost')->name("customer.cost_items"); 

    Route::post('doUpdate', 'CustomerController@doUpdate')->name("customer.doUpdate"); 

    Route::post('doDelete', 'CustomerController@doDelete')->name("customer.doDelete"); 

    Route::post('doDeactive', 'CustomerController@doDeactive')->name("customer.doDeactive"); 
      
});


