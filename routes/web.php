<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/keith', function () {
    return response()->json([
        'version' => app()->version(),
    ]);
});
