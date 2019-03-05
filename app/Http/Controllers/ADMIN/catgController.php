<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\catg;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
use App\section;
class catgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(catg::get());
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
          'title' => 'required',
          'section' => 'required'
        ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        }


         $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/catg/');
        Image::make($request->get('image'))->resize(600,400)->save(public_path('images/catg/').$fileNameimage);

        $section_id = section::where('title',$request->section)->value('id');
        return response()->json(catg::create(['title' => $request->title,'section_id' => $section_id, 'image' => 'images/catg/'.$fileNameimage]));
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

    public function withSection(Request $request) {
        $section_id = section::where('title',$request->section)->value('id');
        return response()->json(catg::where('section_id',$section_id)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section_id = section::where('title',$request->section['title'])->value('id');
        catg::where('id',$request->id)->update([
            'title' => $request->title,
            'section_id' => $section_id
        ]);
    }

    /**.
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
