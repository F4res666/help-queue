<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');


Route::get('/hello', function () {
    return 'Hello from Laravel!';
});

Route::get('/hello/{name}', function (string $name) {
    return view('hello', ['name' => $name]);
});