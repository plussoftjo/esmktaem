<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin',function() {
	return view('admin');
});


/////////////////
/////// Admin Controller
/////////////////////////
Route::get('/admin/section/index','ADMIN\sectionController@index');
Route::post('/admin/section/store','ADMIN\sectionController@store');
Route::post('/admin/section/updateImage/{id}','ADMIN\sectionController@updateImage');
Route::post('/admin/section/update/{id}','ADMIN\sectionController@update');
Route::get('/admin/section/destroy/{id}','ADMIN\sectionController@destroy');


////////////// catg/
Route::post('/admin/catg/store','ADMIN\catgController@store');
Route::get('/admin/catg/index','ADMIN\catgController@index');
Route::post('/admin/catg/update','ADMIN\catgController@update');
Route::post('/admin/catg/withSection','ADMIN\catgController@withSection');

//////////// stars
Route::post('/admin/stars/store','ADMIN\starsController@store');
Route::get('/admin/stars/index','ADMIN\starsController@index');

///// star
Route::get('/admin/star/show/{id}','ADMIN\starController@show');


/////////////// country
Route::get('/admin/country/index','ADMIN\countryController@index');
Route::post('/admin/country/store','ADMIN\countryController@store');


////// city
Route::get('/admin/city/index','ADMIN\cityController@index');
Route::post('/admin/city/store','ADMIN\cityController@store');
Route::post('/admin/city/withCountry','ADMIN\cityController@withCountry');


Route::post('/admin/market/store','ADMIN\marketController@store');
Route::get('/admin/market/index','ADMIN\marketController@index');
Route::post('/admin/market/changeImage/{id}','ADMIN\marketController@changeImage');
Route::post('/admin/market/update/{id}','ADMIN\marketController@update');
Route::post('/admin/market/destroy/{id}','ADMIN\marketController@destroy');
Route::get('/admin/market/show/{id}','ADMIN\marketController@show');




////////////// item controller
Route::post('/admin/item/store/{id}','ADMIN\itemController@store');



////////// Item option Controller 
Route::post('/admin/item/option/store/{id}','ADMIN\optionController@store');


/// entry Controller 
Route::get('/entry/index','ADMIN\entryController@index');
Route::get('/entry/approve/{id}','ADMIN\entryController@approve');