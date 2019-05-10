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
    Route::get('/user/{id}', 'LipstickBrandController@getLipstickByUser');

    Route::post('/brand', 'LipstickBrandController@storeLipstickBrand');
    Route::get('/brand/{lipstick_brand_id}', 'LipstickBrandController@getLipstickByBrand');
    Route::put('/brand/{lipstick_brand_id}', 'LipstickBrandController@editLipstickBrand');
    Route::delete('/brand/{lipstick_brand_id}', 'LipstickBrandController@deleteLipstickBrand');

    Route::post('/detail', 'LipstickDetailController@storeLipstickDetail');
    Route::get('/detail/{lipstick_detail_id}', 'LipstickDetailController@getLipstickByDetail');
    Route::put('/detail/{lipstick_detail_id}', 'LipstickDetailController@editLipstickDetail');
    Route::delete('/detail/{lipstick_detail_id}', 'LipstickDetailController@deleteLipstickDetail');

    Route::post('/', 'LipstickColorController@storeLipstickColor');
    Route::get('{id}', 'LipstickColorController@getLipstickById');
    Route::put('/color/{lipstick_color_id}', 'LipstickColorController@editLipstickColor');
    Route::delete('{id}', 'LipstickColorController@deleteLipstickId');

    Route::put('/image/{lipstick_image_id}', 'LipstickColorController@editLipstickImage');
    Route::delete('/image/{lipstick_image_id}', 'LipstickColorController@deleteLipstickImage');

});

Route::group(['prefix' => 'trend'], function () {
    Route::get('', 'TrendController@getAll');
    Route::get('{id}', 'TrendController@getTrendById');
    Route::post('', 'TrendController@storeTrend');
    Route::put('{id}', 'TrendController@editTrend');
    Route::delete('{id}', 'TrendController@deleteTrend');

});
