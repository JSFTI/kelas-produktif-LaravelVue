<?php

use Illuminate\Http\File;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('resource/image/{resource}/{name}', function($resource, $name){
    $path = storage_path("app/$resource/$name");
    if(!file_exists($path)){
        return response('Not Found', 404);
    }
    return response()->file($path);
})->name('resource.image');;

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
