<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'lipstick'], function () { // localhost/api/lipstick/...
    Route::get('/', 'LipstickController@getAll');
    Route::get('{id}', 'LipstickController@getLipstickById');
    Route::post('', 'LipstickController@storeLipstick');
    Route::delete('{id}', 'LipstickController@deleteLipstickId');


    Route::get('/brand/{lipstick_brand_id}', 'LipstickController@getLipstickByBrand');
    Route::put('/brand/{lipstick_brand_id}', 'LipstickController@editLipstickBrand');
    Route::delete('/brand/{lipstick_brand_id}', 'LipstickController@deleteLipstickBrand');

    Route::get('/name/{lipstick_detail_id}', 'LipstickController@getLipstickByName');
    Route::put('/detail/{lipstick_detail_id}', 'LipstickController@editLipstickDetail');
    Route::delete('/detail/{lipstick_detail_id}', 'LipstickController@deleteLipstickDetail');

    Route::put('/color/{lipstick_color_id}', 'LipstickController@editLipstickColor');

    Route::put('/image/{lipstick_image_id}', 'LipstickController@editLipstickImage');
    Route::delete('/image/{lipstick_image_id}', 'LipstickController@deleteLipstickImage');

});

Route::group(['prefix' => 'trend'], function () {
    Route::get('', 'TrendController@getAll');
    Route::get('{id}', 'TrendController@getTrendById');
    // Route::get('/title/{title}', 'TrendController@getTrendByTitle');
    // Route::get('/year/{year}', 'TrendController@getTrendByYear');

    Route::post('', 'TrendController@storeTrend');

    Route::put('{id}', 'TrendController@editTrend');

    Route::delete('{id}', 'TrendController@deleteTrend');

});
