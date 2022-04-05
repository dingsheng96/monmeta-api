<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')
    ->group(function () {

        Route::post('oAuth2', 'TokenController@giveOAuth2Token');

        Route::middleware('auth:api')
            ->group(function () {

                Route::prefix('gameHistory')
                    ->group(function () {

                        Route::post('store', 'GameController@storeGameHistory');
                    });
            });
    });
