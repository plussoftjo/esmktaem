<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\market;
use App\catg;
use App\item;
class marketController extends Controller
{
    public function fetch($id)
    {
    	$market = market::where('id',$id)->firstOrFail();
    	$catgs = explode(',',$market->catgs);
    	$catgsArray = array();
    	foreach ($catgs as $k) {
    		$catgsArray[] = catg::where('title',$k)->first();
    	}
        $type= 1;

        $items = item::where('market_id',$id)->get();

    	return response()->json(['market' => $market,'catgs' => $catgsArray,'items' => $items,'type' => $type]);
    }

    public function fetchInRandome() {
        return response()->json(market::inRandomOrder()->take(10)->get());
    }

    public function marketsSearch(Request $request)
    {
        $fetch = market::where('title', 'like', '%'.$request->search.'%')->get();
        return response()->json($fetch);
    }
}
// 
