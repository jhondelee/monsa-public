<?php

/*
|--------------------------------------------------------------------------
| Sales Commission
|--------------------------------------------------------------------------

*/
// Assign Area
Route::group(['prefix' => 'assign-area'], function() {  

    Route::get('/', 'AssignedAreaController@index')->name("assign_area.index");
    
    Route::get('add', 'AssignedAreaController@create')->name("assign_area.create");

    Route::post('add', 'AssignedAreaController@store')->name("assign_area.store");

    Route::get('edit/{id}', 'AssignedAreaController@edit')->name("assign_area.edit");    

    Route::post('edit/{id}', 'AssignedAreaController@update')->name("salesorder.update"); 

    Route::get('delete/{id}', 'AssignedAreaController@destroy')->name("assign_area.delete");    

    Route::get('print/{id}', 'AssignedAreaController@printSO')->name("assign_area.print"); 

});

// Agent Commission
Route::group(['prefix' => 'agent-commission'], function() {  

    Route::get('/', 'AgentCommissionController@index')->name("commission.index");
    
    Route::get('add', 'AgentCommissionController@create')->name("commission.create");

    Route::post('add', 'AgentCommissionController@store')->name("commission.store");

    Route::get('edit/{id}', 'AgentCommissionController@edit')->name("commission.edit");    

    Route::post('edit/{id}', 'AgentCommissionController@update')->name("commission.update"); 

    Route::get('delete/{id}', 'AgentCommissionController@destroy')->name("commission.delete");    

    Route::get('print/{id}', 'AgentCommissionController@printSO')->name("commission.print"); 

});