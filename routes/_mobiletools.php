<?php

/*
|--------------------------------------------------------------------------
| Sales Mobile Tools
|--------------------------------------------------------------------------

*/



Route::group(['prefix' => 'event-photo'], function() {    

    Route::get('/', 'EventPhotoController@index')->name("event.index");

    Route::get('add', 'EventPhotoController@create')->name("event.create");

    Route::post('add', 'EventPhotoController@store')->name("event.store");

    Route::get('edit/{id}', 'EventPhotoController@edit')->name("event.edit");  

    Route::post('edit/{id}', 'EventPhotoController@update')->name("event.update"); 

    Route::get('delete/{id}', 'EventPhotoController@destroy')->name("event.delete"); 

});


Route::group(['prefix' => 'brochure'], function() {    

    Route::get('/', 'BrochureController@index')->name("brochure.index");

    Route::get('add', 'BrochureController@create')->name("brochure.create");

    Route::post('add', 'BrochureController@store')->name("brochure.store");

    Route::get('edit/{id}', 'BrochureController@edit')->name("brochure.edit");  

    Route::post('edit/{id}', 'BrochureController@update')->name("brochure.update"); 

    Route::get('delete/{id}', 'BrochureController@destroy')->name("brochure.delete"); 

});



Route::group(['prefix' => 'calendar-schedule'], function() {    

    Route::get('/', 'CalendarScheduleController@index')->name("calendar.index");

    Route::get('add', 'CalendarScheduleController@create')->name("calendar.create");

    Route::post('add', 'CalendarScheduleController@store')->name("calendar.store");

    Route::get('edit/{id}', 'CalendarScheduleController@edit')->name("calendar.edit");  

    Route::post('edit/{id}', 'CalendarScheduleController@update')->name("calendar.update"); 

    Route::get('delete/{id}', 'CalendarScheduleController@destroy')->name("calendar.delete"); 

});


