<?php

use App\Http\Controllers\ApiController;
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
Route::get('getcompany/{sectorid}', 'ApiController@getCompany');
Route::get('fetch/dse', 'ApiController@fetchDSE');

Route::get('news/{time}', 'ApiController@getAllNews');
Route::get('news/from/{from}/to/{to}', 'ApiController@getCustomRangeNews');
Route::get('news/last_id/{last_id}', 'ApiController@getNewsByLastId');
Route::get('news/last_id/{last_id}/{category_id}', 'ApiController@getNewsByCategory');