<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/provinces","ApiController@provinces");
Route::get("/districts/{province}","ApiController@districts");
Route::get("/sectors/{district}","ApiController@sectors");
Route::get("/cells/{sector}","ApiController@cells");
Route::get("/villages/{village}","ApiController@villages");
