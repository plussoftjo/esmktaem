<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\item;
use App\market;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
class itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
       
        $validator = Validator::make($request->all(), [
          'image' => 'required|image64:jpeg,jpg,png',
          'title' => 'required',
          'des' => 'required',
          'price' => 'required',
          'catg' => 'required'
        ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        }


        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/item/');
        Image::make($request->get('image'))->resize(600,400)->save(public_path('images/item/').$fileNameimage);

        return response()->json(item::create([
            'title' => $request->title,
            'image' => 'images/item/'.$fileNameimage,
            'des' => $request->des,
            'price' => $request->price,
            'catg' => $request->catg,
            'market_id' => $id
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
