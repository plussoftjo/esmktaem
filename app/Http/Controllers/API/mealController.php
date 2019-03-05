<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\meal;
use Auth;
class mealController extends Controller
{
    public function store(Request $req) {
    	meal::create([
    		'user_id' => Auth::id(),
    		'item_id' => $req->item_id,
    		'type' => $req->type
    	]);  
    }

    public function fetch($id) {
    	$fav = meal::where('user_id',$id)->where('type','fav')->get();
    	$one = meal::where('user_id',$id)->where('type','one')->get();
    	$tow = meal::where('user_id',$id)->where('type','tow')->get();
    	$three = meal::where('user_id',$id)->where('type','three')->get();
    	return response()->json(['fav' => $fav,'one'=>$one,'tow'=>$tow,'three'=>$three]);
    }
}
