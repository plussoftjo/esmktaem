<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\bags;
use Auth;
use App\bags_options;
class bagsController extends Controller
{
    public function store(Request $request) 
    {
    	$bags = bags::create([
    		'user_id' => Auth::id(),
    		'item_id' => $request->item_id,
    		'qty' => $request->qty
    	]);

    	foreach ($request->checkBoxItem as $c) {
    		if($c['select'] == true) {
	    		bags_options::create([
	    			'bags_id' => $bags->id,
	    			'option_id' => $c['id'],
	    			'value' => $c['text']
	    		]);	
    		}
    		
    	}

    	// foreach ($request->selectItem as $s) {
    	// 	bags_options::create([
    	// 		'bags_id' => $bags->id,
    	// 		'option_id' => $s['id'],
    	// 		'value' => $s['select'],
    	// 		'title' => $s['title']
    	// 	]);
    	// }
        // remake this 
    }

    public function index() {
        return response()->json(bags::where('user_id',Auth::id())->get());
    }
}
