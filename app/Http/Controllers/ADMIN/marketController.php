<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\market;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
use App\section;
use App\User;
class marketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(market::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
          'image' => 'required|image64:jpeg,jpg,png',
          'name' => 'required',
          'phone' => 'required|unique:users',
          'password' => 'required',
          'country' => 'required',
          'des' => 'required',
          'rate' => 'required'
        ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        }

         $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/market/');
        Image::make($request->get('image'))->resize(600,600)->save(public_path('images/market/').$fileNameimage);
        $color = Image::make($request->get('image'))->pickColor(100,100,'hex');
        $user = User::create([
            'phone' => $request->phone,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'type' => 'market',
            'gender' => '0',
            'image' => 'images/market/'.$fileNameimage
        ]);

        $section_id = section::where('title',$request->section)->value('id');
        market::create([
            'user_id' => $user->id,
            'country' => $request->country,
            'city' => $request->city,
            'catgs' => $request->catgs,
            'section_id' => $section_id,
            'logo' => 'images/market/'.$fileNameimage,
            'des' => $request->des,
            'rate' => $request->rate,
            'color' => $color,
            'title' => $request->name
        ]);

        return response()->json(['color' => $color]);


    }

    public function changeImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
          'image' => 'required|image64:jpeg,jpg,png',
        ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        }

          $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/market/');
        Image::make($request->get('image'))->resize(600,600)->save(public_path('images/market/').$fileNameimage);

        market::where('id',$id)->update(['logo' => 'images/market/'.$fileNameimage]);

        return response()->json(['image' => 'images/market/'.$fileNameimage]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(market::where('id',$id)->firstOrFail());
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
         $validator = Validator::make($request->user, [
          'name' => 'required',
          'phone' => 'required',
        ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        }
        $validator = Validator::make($request->all(), [
          'des' => 'required',
        ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        }

        User::where('id',$request->user['id'])->update(['name' => $request->user['name'],'phone' => $request->user['phone']]);

        market::where('id',$id)->update(['des' => $request->des]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = market::where('id',$id)->value('user_id');
        User::where('id',$user_id)->delete();
        market::where('id',$id)->delete();
    }
}
