<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\option;
use App\optionList;
class optionController extends Controller
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
        if($request->option['type'] == 'عدة اختيارات')
        {
            $option =  option::create([
                'title' => $request->option['title'],
                'type' => $request->option['type'],
                'item_id' => $id
            ]);

            foreach ($request->optionList as $o) {
                optionList::create([
                    'title' => $o['title'],
                    'price' => $o['price'],
                    'option_id' => $option->id
                ]);
            }
        }else{
            $option = option::create([
                'title' => $request->option['title'],
                'type' => $request->option['type'],
                'price' => $request->option['price'],
                'item_id' => $id
            ]);
        }
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
