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
    Route::get('/color/{rgb}', 'LipstickColorController@getSimilarColor');

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


// Route::post('sign-in', 'UserController@authentication');
// Route::post('sign-out', 'UserController@logout');

// Route::group(['prefix' => 'lipstick'], function () {

//     Route::get('', 'LipstickController@getAllLipstick');
//     Route::get('{lipstick_id}', 'LipstickController@getLipstickById');
//     Route::post('', 'LipstickController@createLipstick');
//     Route::put('{lipstick_id}', 'LipstickController@updateLipstickById');
//     Route::delete('{lipstick_id', 'LipstickController@deleteLipstickById');

//     Route::get('color/{rgb}', 'LipstickController@getSimilarLipstickColor');
// });

// Route::group(['prefix' => 'brand'], function () {

//     Route::get('', 'BrandController@getAllBrand');
//     Route::get('{brand_id}', 'BrandController@getBrandById');
//     Route::post('', 'BrandController@createBrand');
//     Route::put('{brand_id}', 'BrandController@updateBrandById');
//     Route::delete('{brand_id', 'BrandController@deleteBrandById');
// });

// Route::group(['prefix' => 'trend'], function () {

//     Route::get('', 'TrendController@getAllTrend');
//     Route::get('{trend_id}', 'TrendController@getTrendById');
//     Route::post('', 'TrendController@createTrend');
//     Route::put('{trend_id}', 'TrendController@updateTrendById');
//     Route::delete('{trend_id', 'TrendController@deleteTrendById');
// });

// Route::group(['prefix' => 'user'], function () {

//     Route::get('', 'UserController@getAllUser');
//     Route::get('{user_id}', 'UserController@getUserById');
//     Route::post('', 'UserController@createUser');
//     Route::put('{user_id}', 'UserController@updateUserById');
//     Route::delete('{user_id}', 'UserController@deleteUserById');

//     Route::post('{user_id}/favorite-lipstick/{lipstick_id}', 'UserController@addLipstickToFavorite');
//     Route::delete('{user_id}/favorite-lipstick/{lipstick_id}', 'UserController@removeLipstickFromFavorite');

//     Route::post('{user_id}/favorite-trend/{trend_id}', 'UserController@addTrendToFavorite');
//     Route::delete('{user_id}/favorite-trend/{trend_id}', 'UserController@removeTrendFromFavorite');

//     Route::post('{user_id}/location', 'UserController@sendUserLocation');
// });
