<?php

Route::get('files', 'FileController@index')->name('files');
Route::post('files/new-file', 'FileController@store')->name('send-files');
Route::post('files/create-folder', 'FileController@createFolder')->name('create-folder');
Route::get('files/get-all', 'FileController@storeDirectorieFiles')->name('files-get-all');