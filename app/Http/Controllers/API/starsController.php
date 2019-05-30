<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\star;
use App\User;
class starsController extends Controller
{
    public function randIndex()
    {
    	return response()->json(star::inRandomOrder()->take(5)->get());
    }

    public function show($id) {
    	return response()->json(star::where('id',$id)->firstOrFail());
    }

    public function index() {
    	return response()->json(User::where('type','stars')->orderBy('name','asc')->get());
    }

    public function fetchStars() {
        $male = User::where('type','stars')->where('gender','male')->inRandomOrder()->take(10)->get();
        $female = User::where('type','stars')->where('gender','female')->inRandomOrder()->take(10)->get();
        return response()->json(['male' => $male,'female' =>$female]);
    }

    public function search($e) {
        return response()->json(User::where('type','stars')->where('name','like',$e.'%')->take(10)->get());
    }

    public function searchFull($e) {
        return response()->json(User::where('type','stars')->where('name','like',$e.'%')->take(10)->get());
    } 
}
