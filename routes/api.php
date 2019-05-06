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
    Route::get('', 'LipstickBrandController@getAll');
    Route::get('{id}', 'LipstickBrandController@getLipstickById');
    Route::post('', 'LipstickBrandController@storeLipstick');
    Route::delete('{id}', 'LipstickBrandController@deleteLipstickId');
    Route::get('/user/{id}', 'LipstickBrandController@getLipstickByUser');


    Route::get('/brand/{lipstick_brand_id}', 'LipstickBrandController@getLipstickByBrand');
    Route::put('/brand/{lipstick_brand_id}', 'LipstickBrandController@editLipstickBrand');
    Route::delete('/brand/{lipstick_brand_id}', 'LipstickBrandController@deleteLipstickBrand');

    Route::get('/detail/{lipstick_detail_id}', 'LipstickBrandController@getLipstickByDetail');
    Route::put('/detail/{lipstick_detail_id}', 'LipstickBrandController@editLipstickDetail');
    Route::delete('/detail/{lipstick_detail_id}', 'LipstickBrandController@deleteLipstickDetail');

    Route::put('/color/{lipstick_color_id}', 'LipstickBrandController@editLipstickColor');

    Route::put('/image/{lipstick_image_id}', 'LipstickBrandController@editLipstickImage');
    Route::delete('/image/{lipstick_image_id}', 'LipstickBrandController@deleteLipstickImage');

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
