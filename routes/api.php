<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'lipstick'], function () { // localhost/api/lipstick/...
    Route::get('', 'LipstickBrandController@getAll');

    Route::post('detail', 'LipstickDetailController@storeLipstickDetail');
    Route::get('detail/{lipstick_detail_id}', 'LipstickDetailController@getLipstickById');
    Route::get('type', 'LipstickDetailController@getType');
    Route::put('detail/{lipstick_detail_id}', 'LipstickDetailController@editLipstickDetail');
    Route::delete('detail/{lipstick_detail_id}', 'LipstickDetailController@deleteLipstickDetail');
    Route::delete('detail', 'LipstickDetailController@destroyMany');

    Route::post('', 'LipstickColorController@storeLipstickColor');
    Route::get('{id}', 'LipstickColorController@getLipstickById');
    Route::get('color/{rgb}', 'LipstickColorController@getSimilarColor');
    Route::put('color/{lipstick_color_id}', 'LipstickColorController@editLipstickColor');
    Route::delete('{id}', 'LipstickColorController@deleteLipstickId');
    Route::delete('', 'LipstickColorController@destroyMany');

    Route::put('image/{lipstick_image_id}', 'LipstickColorController@editLipstickImage');
    Route::delete('image/{lipstick_image_id}', 'LipstickColorController@deleteLipstickImage');

});

Route::group(['prefix' => 'trend'], function () {
    Route::get('', 'TrendController@getAll');
    Route::get('{id}', 'TrendController@getTrendById');
    Route::post('', 'TrendController@storeTrend');
    Route::put('{id}', 'TrendController@editTrend');
    Route::delete('{id}', 'TrendController@deleteTrend');
    Route::delete('', 'TrendController@destroyMany');
});

Route::group(['prefix' => 'brand'], function() {
    Route::post('', 'LipstickBrandController@storeLipstickBrand');
    Route::get('{lipstick_brand_id}', 'LipstickBrandController@getLipstickByBrand');
    Route::put('{lipstick_brand_id}', 'LipstickBrandController@editLipstickBrand');
    Route::delete('{lipstick_brand_id}', 'LipstickBrandController@deleteLipstickBrand');
    Route::delete('', 'LipstickBrandController@destroyMany');
});
