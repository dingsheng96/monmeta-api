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
    ->prefix('v1')
    ->group(function () {

        Route::get('oAuth2', 'TokenController@getOAuth2Token');

        Route::post('register', 'AccountController@register');

        Route::get('countries', 'CountryController@index');

        Route::get('leaderboard', 'LeaderBoardController@index');

        Route::middleware('auth:api')
            ->group(function () {

                Route::prefix('gameHistory')
                    ->group(function () {
                        Route::get('list', 'GameHistoryController@index');
                        Route::post('store', 'GameHistoryController@store');
                    });

                Route::prefix('transactions')
                    ->group(function () {
                        Route::get('list', 'TransactionController@index');
                        Route::post('store', 'TransactionController@store');
                    });

                Route::prefix('nft')
                    ->group(function () {
                        Route::get('show', 'NftController@show');
                        Route::post('store', 'NftController@store');
                    });
            });
    });
