<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\star;
class starController extends Controller
{
   	public function show($id)
   	{
   		return response()->json(star::where('id',$id)->firstOrFail());
   	}
}
