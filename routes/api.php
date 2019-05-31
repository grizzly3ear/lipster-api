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


Route::group(['prefix' => 'brand'], function () {
	Route::get('', 'LipstickBrandController@getAllLipstickBrand');
	Route::get('{lipstickBrand_id}', 'LipstickBrandController@getLipstickBrandById');
	Route::get('{lipstickBrand_id}/detail', 'LipstickBrandController@getLipstickDetailByLipstickBrandId');
	Route::post('', 'LipstickBrandController@createLipstickBrand');
	Route::put('{lipstickBrand_id}', 'LipstickBrandController@updateLipstickBrandById');
    Route::delete('{lipstickBrand_id}', 'LipstickBrandController@deleteLipstickBrandById');

    Route::delete('', 'LipstickBrandController@destroyLipstickBrandByIds');
});

Route::group(['prefix' => 'lipstick'], function () {

    Route::group(['prefix' => 'detail'], function () {
        Route::get('', 'LipstickDetailController@getAllLipstickDetail');
        Route::get('{lipstickDetail_id}', 'LipstickDetailController@getLipstickDetailById')->where('lipstickDetail_id', '[0-9]+');
        Route::post('', 'LipstickDetailController@createLipstickDetail');
        Route::put('{lipstickDetail_id}', 'LipstickDetailController@updateLipstickDetailById');
        Route::delete('{lipstickDetail_id}', 'LipstickDetailController@deleteLipstickDetailById');

        Route::get('/type', 'LipstickDetailController@getLipstickDetailType');
    });
});

