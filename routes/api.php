<?php

use Illuminate\Http\Request;


/////
// Section Controller
//////// 
Route::get('sections/index','API\sectionController@index');


///////////
///  star Controller
////////////

Route::get('/star/rand/index','API\starsController@randIndex');
Route::get('/star/show/{id}','API\starsController@show');

///////
// Market Controller
/////////// 

Route::get('/market/fetch/{id}','API\marketController@fetch');

/////// 
///// Item Controller
/////////

Route::get('/item/show/{id}','API\itemController@show');



////////////////
/////// User controller 
////////////////// 
Route::post('/user/login','API\userController@login');
Route::post('/user/reg','API\userController@reg');

///////////
////////// API AUTH
/////////////

Route::group(['middleware' => 'auth:api'], function(){

	Route::get('/user/details','API\userController@details');
	//////////
	///// bags Controller
	////////////////
	Route::post('/bag/store','API\bagsController@store');
	Route::get('/bag/index','API\bagsController@index');


	/////////
	////// Store Controller
	////////////
	Route::post('/store/store','API\storeController@store');
	Route::get('/store/index','API\storeController@index');


	/////////
	//// Entry Controller 
	//////////
	Route::post('/entry/store','API\entryController@store');
	Route::get('/entry/check','API\entryController@check');

	//////
	/// Stars Store Controller 
	///////
	Route::get('/stars/store/index','API\storeController@starStore');
	Route::get('/stars/search/{e}','API\starsController@search');
	Route::get('/stars/searchFull/{e}','API\starsController@search');

	//////// 
	/// EsmkT3m Controller 
	//////
	Route::get('/esmkStore/index','API\storeController@esmkStoreIndex');
	Route::post('/esmkStore/show','API\storeController@esmkStoreShow');

	//////////
	//// Market Controlller 
	////////// 
	Route::get('/fetch/market/inRandome','API\marketController@fetchInRandome');

	///////
	// Section Controller 
	/////////
	Route::get('section/show/{id}','API\sectionController@show');

	Route::get('user/show/{id}','API\userController@show');

	// Change Image
	Route::post('/user/change_image/{id}','API\userController@changeImage');

	/// Search Market 
	Route::post('/markets/search','API\marketController@marketsSearch');

	///// meal Controller 
	Route::post('/meal/store','API\mealController@store');
	Route::get('/meal/fetch/{id}','API\mealController@fetch');
	Route::get('/stars/index','API\starsController@index');


	//// Stars Fetch
	// main Page
	Route::get('/stars/fetchMF','API\starsController@fetchStars');


	//// Search Controller 
	Route::post('/full_search','API\searchController@full_search');


	// FAV CONTROLLER 
	Route::get('/fav/market/store/{id}','API\favController@store_market');
	Route::get('/fav/star/store/{id}','API\favController@store_star');
	Route::get('/fav/market/get','API\favController@fetch_market');
	Route::get('/fav/star/get','API\favController@fetch_star');
	Route::get('/fav/market/check/{id}','API\favController@market_check');
	Route::get('/fav/star/check/{id}','API\favController@star_check');
});