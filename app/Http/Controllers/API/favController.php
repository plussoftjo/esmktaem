<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\favmarket;
use App\starfav;
class favController extends Controller
{
    public function store_market($id)
    {
    	$favmarket = favmarket::where('user_id',Auth::id())->where('market_id', $id)->count();
    	if($favmarket == 0)
    	{
    		favmarket::create([
    		'market_id' => $id,
    		'user_id' => Auth::id()
    		]);
    	}else {
    		favmarket::where('user_id',Auth::id())->where('market_id', $id)->delete();
    	}
    	
    	return response()->json('ok',200);
    }

    public function store_star($id)
    {
    	

     	$starfav = starfav::where('auth',Auth::id())->where('user_id', $id)->count();

    	if($starfav == 0)
    	{
    		starfav::create([
    		'user_id' => $id,
    		'auth' => Auth::id()
     	]);
    	}else {
    		starfav::where('auth',Auth::id())->where('user_id', $id)->delete();
    	}
    }

    public function fetch_market()
    {
    	return response()->json(favmarket::where('user_id',Auth::id())->get());
    }

    public function fetch_star()
    {
    	return response()->json(starfav::where('auth',Auth::id())->get());
    }

    public function market_check($id) {
    	$favmarket = favmarket::where('user_id',Auth::id())->where('market_id', $id)->count();

    	if($favmarket == 0)
    	{
    		return response()->json(['is_fav' => false]);
    	}else {
    		return response()->json(['is_fav' => true]);
    	}
    }

    public function star_check($id) {
    	$starfav = starfav::where('auth',Auth::id())->where('user_id', $id)->count();

    	if($starfav == 0)
    	{
    		return response()->json(['is_fav' => false]);
    	}else {
    		return response()->json(['is_fav' => true]);
    	}
    }
}
