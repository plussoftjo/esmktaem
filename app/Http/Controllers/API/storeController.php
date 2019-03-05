<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\store;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
use App\User;
class storeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mystore = store::where('user_id',Auth::id())->orderBy('id','decs')->firstOrFail();

        return response()->json(['mystore' => $mystore]);
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
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        }
        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/store/');
        Image::make($request->get('image'))->resize(600,400)->save(public_path('images/store/').$fileNameimage);

        $user_type = User::where('id',Auth::id())->value('type');
        if($user_type == 'stars')
        {
           if($request->type == 'اسمك طعم') {
                $type = 2;
            }else {
                $type = 1;
            }
        }else {
            if($request->type == 'اسمك طعم') {
                $type = 2;
            }else {
                $type = 0;
            }
        }

        $store = store::create([
            'image' => 'images/store/'.$fileNameimage,
            'user_id' => Auth::id(),
            'item_id' => 0,
            'content' => $request->content,
            'type' => $type
        ]);
        return response()->json($store);

    }

    public function starStore() {

        $fetch = store::where('type', 1)->get();
        $grouped =  $fetch->groupBy('user_id');

        return response()->json($grouped);
    }

    public function esmkStoreIndex() {
        $fetch = store::where('type',2)->orderBy('id','decs')->firstOrFail();
        return response()->json($fetch);
    }

    public function esmkStoreShow(Request $request)
    {
        if($request->slide == 'left'){
            $id = $request->id - 1;
            $fetch = store::where('id',$id)->firstOrFail();
            return response()->json($fetch);                
        }else {
           $id = $request->id + 1;
            $fetch = store::where('id','<', $id)->firstOrFail();
            return response()->json($fetch);
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
