<?php

use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function() {

    Route::apiResource('/media', 'API\MediaController')->only(['store','update']);
    Route::post('/media/upload', 'API\MediaController@upload')
        ->name('media.upload');
});

Route::get('test', function () {
    return ['test' => 'test'];
});