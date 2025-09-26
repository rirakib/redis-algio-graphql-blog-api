<?php

use App\Http\Controllers\V1\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->controller(FrontendController::class)->group(function(){
    Route::get('posts','posts');
    Route::get('categories','categories');
});