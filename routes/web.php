<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController');
Route::get('/api/songs', 'SongController@index');
