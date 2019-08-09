<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@create');
Route::post('login', 'Auth\LoginController@authenticated');

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'lipstick'], function () {
        Route::group(['prefix' => 'color'], function () {
            Route::post('{lipstickColor_id}/reviews', 'ReviewController@createReview');
            Route::put('{lipstickColor_id}/reviews/{review_id}', 'ReviewController@updateReviewById')->where('review_id', '[0-9]+');
            Route::delete('{lipstickColor_id}/reviews/{review_id}', 'ReviewController@deleteReviewById')->where('review_id', '[0-9]+');

            Route::group(['prefix' => 'favorite'], function () {
                Route::get('', 'FavoriteLipstickController@getAllFavoriteLipstick');
                Route::get('{favoriteLipstick_id}', 'FavoriteLipstickController@getFavoriteLipstickById')->where('favoriteLipstick_id', '[0-9]+');
                Route::get('/user/{userId}', 'UserController@getFavoriteLipstickByUserId')->where('userId', '[0-9]+');
                Route::post('', 'FavoriteLipstickController@createFavoriteLipstick');
                Route::delete('{lipstick_color_id}', 'FavoriteLipstickController@deleteFavoriteLipstickById')->where('favoriteLipstick_id', '[0-9]+');
            });
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('', 'UserController@getAllUser');
        Route::get('{user_id}', 'UserController@getUserById')->where('user_id', '[0-9]+');
        Route::put('{user_id}', 'UserController@updateUserById')->where('user_id', '[0-9]+');
        Route::delete('{user_id}', 'UserController@deleteUserById')->where('user_id', '[0-9]+');
    });
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

        Route::get('{lipstickColor_id}/reviews', 'LipstickColorController@getUserReviews')->where('lipstickColor_id', '[0-9]+');
        Route::get('rgb/{hex}', 'LipstickColorController@getSimilarLipstickColor')->where('hex', '[a-fA-F0-9]{6}');
    });

    Route::group(['prefix' => 'image'], function () {
        Route::get('', 'LipstickImageController@getAllLipstickImage');
        Route::get('{lipstickImage_id}', 'LipstickImageController@getLipstickImageById')->where('lipstickImage_id', '[0-9]+');
        Route::post('', 'LipstickImageController@storeFileToImage');
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

    Route::group(['prefix' => ''], function () {
        Route::get('', 'StoreController@getAllStore');
        Route::get('{store_id}', 'StoreController@getStoreById')->where('store_id', '[0-9]+');
        Route::post('', 'StoreController@createStore');
        Route::put('{store_id}', 'StoreController@updateStoreById')->where('store_id', '[0-9]+');
        Route::delete('{store_id}', 'StoreController@deleteStoreById')->where('store_id', '[0-9]+');
    });

    Route::group(['prefix' => 'address'], function () {
        Route::get('', 'StoreAddressController@getAllStoreAddress');
        Route::get('{storeAddress_id}', 'StoreAddressController@getStoreAddressById')->where('storeAddress_id', '[0-9]+');
        Route::post('', 'StoreAddressController@createStoreAddress');
        Route::put('{storeAddress_id}', 'StoreAddressController@updateStoreAddressById')->where('storeAddress_id', '[0-9]+');
        Route::delete('{storeAddress_id}', 'StoreAddressController@deleteStoreAddressById')->where('storeAddress_id', '[0-9]+');
    });

});

Route::group(['prefix' => 'user'], function () {
	Route::post('', 'UserController@createUser');
});


