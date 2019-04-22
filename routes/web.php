<?php

Route::get('files', 'FileController@index')->name('files');
Route::post('files/new-file', 'FileController@store')->name('send-files');
Route::post('files/create-folder', 'FileController@createFolder')->name('create-folder');
Route::get('files/get-all', 'FileController@storeDirectorieFiles')->name('files-get-all');
/* 
* Rotas para manutenção de imagens
*/
Route::put('image-update', 'FileController@imageUpdate')->name('files-image-update');
Route::delete('image-delete', 'FileController@imageDestroy')->name('files-image-delete');
Route::patch('image-rename', 'FileController@imageRename')->name('files-image-rename');
/*
* Rotas para manutenção de pastas
*/
Route::patch('folder-rename', 'FileController@folderRename')->name('files-folder-rename');
Route::delete('folder-delete', 'FileController@folderDestroy')->name('files-folder-delete');

