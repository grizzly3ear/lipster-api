<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
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

    Route::group(['prefix' => 'color'], function () {
        Route::get('', 'LipstickColorController@getAllLipstickColor');
        Route::get('{lipstickColor_id}', 'LipstickColorController@getLipstickColorById')->where('lipstickColor_id', '[0-9]+');
        Route::post('', 'LipstickColorController@createLipstickColor');
        Route::put('{lipstickColor_id}', 'LipstickColorController@updateLipstickColorById')->where('lipstickColor_id', '[0-9]+');
        Route::delete('{lipstickColor_id}', 'LipstickColorController@deleteLipstickColorById')->where('lipstickColor_id', '[0-9]+');

        Route::get('rgb/{hex}', 'LipstickColorController@getSimilarLipstickColor')->where('hex', '[a-fA-F0-9]{6}');
    });

    Route::group(['prefix' => 'image'], function () {
        Route::get('', 'LipstickImageController@getAllLipstickImage');
        Route::get('{lipstickImage_id}', 'LipstickImageController@getLipstickImageById')->where('lipstickImage_id', '[0-9]+');
        Route::post('', 'LipstickImageController@createLipstickImage');
        Route::put('{lipstickImage_id}', 'LipstickImageController@updateLipstickImageById')->where('lipstickImage_id', '[0-9]+');
        Route::delete('{lipstickImage_id}', 'LipstickImageController@deleteLipstickImageById')->where('lipstickImage_id', '[0-9]+');
    });

});

Route::group(['prefix' => 'trend'], function () {
	Route::get('', 'TrendController@getAllTrend');
	Route::get('{trend_id}', 'TrendController@getTrendById')->where('trend_id', '[0-9]+');
	Route::post('', 'TrendController@createTrend');
	Route::put('{trend_id}', 'TrendController@updateTrendById')->where('trend_id', '[0-9]+');
	Route::delete('{trend_id}', 'TrendController@deleteTrendById')->where('trend_id', '[0-9]+');
});

Route::group(['prefix' => 'store'], function () {
	Route::get('', 'StoreController@getAllStore');
	Route::get('{store_id}', 'StoreController@getStoreById')->where('store_id', '[0-9]+');
	Route::post('', 'StoreController@createStore');
	Route::put('{store_id}', 'StoreController@updateStoreById')->where('store_id', '[0-9]+');
	Route::delete('{store_id}', 'StoreController@deleteStoreById')->where('store_id', '[0-9]+');
});
