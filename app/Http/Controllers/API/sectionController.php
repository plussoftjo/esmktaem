<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\section;
use App\market;
use App\catg;
class sectionController extends Controller
{
    public function index()
    {
    	return response()->json(section::get());
    }

    public function show($id)
    {
    	$markets = market::where('section_id',$id)->get();
    	$catgs = catg::where('section_id',$id)->get();
    	return response()->json(['markets' => $markets,'catgs' => $catgs]);
    }
}
