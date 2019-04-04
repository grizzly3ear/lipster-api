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
    Route::get('', 'LipstickController@getAll');
    Route::get('{id}', 'LipstickController@getLipstickById');
    Route::get('/brand/{lipstick_brand_id}', 'LipstickController@getLipstickByBrand');
    Route::get('/name/{lipstick_detail_id}', 'LipstickController@getLipstickByName');
    
    
    // Route::post('', '....') create lipstick
    Route::post('', 'LipstickController@storeLipstick');

    // ::put edit lipstick
    // Route::put('{id}', 'LipstickController@editLipstick');
    Route::put('/brand/{lipstick_brand_id}', 'LipstickController@editLipstickBrand');
    Route::put('/detail/{lipstick_detail_id}', 'LipstickController@editLipstickDetail');
    Route::put('/color/{lipstick_color_id}', 'LipstickController@editLipstickColor');
    Route::put('/image/{lipstick_image_id}', 'LipstickController@editLipstickImage');
    
    // delete lipstick
    Route::delete('{id}', 'LipstickController@deleteLipstickId');
    Route::delete('/brand/{lipstick_brand_id}', 'LipstickController@deleteLipstickBrand');
    Route::delete('/detail/{lipstick_detail_id}', 'LipstickController@deleteLipstickDetail');
    Route::delete('/image/{lipstick_image_id}', 'LipstickController@deleteLipstickImage');
    

});

