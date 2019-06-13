<?php

Route::post('/book', 'BooksController@store');
Route::patch('/book/{book}', 'BooksController@update');
