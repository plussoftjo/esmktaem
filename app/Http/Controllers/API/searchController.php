<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\market;
class searchController extends Controller
{
    public function full_search(Request $request)
    {
    	if($request->type == 'stars')
    	{
    		return response()->json(User::where('name','like','%'.$request->search.'%')->where('type','stars')->get());
    	}

    	if($request->type == 'profile')
    	{
    		return response()->json(User::where('name','like','%'.$request->search.'%')->where('type','customer')->get());
    	}

    	if($request->type == 'res')
    	{
    		return response()->json(market::where('title','like','%'.$request->search.'%')->get());
    	}
    }
}
