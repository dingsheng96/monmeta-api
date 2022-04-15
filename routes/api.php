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

        Route::get('oAuth2', 'TokenController@getOAuth2Token');

        Route::get('countries', 'CountryController@index');

        Route::middleware('auth:api')
            ->group(function () {

                Route::post('register', 'AccountController@register');

                Route::prefix('nft')
                    ->group(function () {

                        Route::get('profile', 'NftController@profile');
                        Route::post('update', 'NftController@update');

                        Route::prefix('gameHistory')
                            ->group(function () {
                                Route::get('list', 'GameHistoryController@index');
                                Route::post('store', 'GameHistoryController@store');
                            });

                        // Route::prefix('financialHistory')
                        //     ->group(function () {
                        //         Route::post('list', 'GameController@listGameHistory');
                        //         Route::post('store', 'GameController@storeGameHistory');
                        //     });
                    });
            });
    });
