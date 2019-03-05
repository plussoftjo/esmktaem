<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Image;
use Carbon\Carbon;
class userController extends Controller
{
   public function reg(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required|unique:users', 
            'password' => 'required', 
            'gender' => 'required', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']);

       $user =  User::create([
            'name' => $input['name'],
            'password' => $input['password'],
            'phone' => $input['phone'],
            'gender' => $input['gender'],
            'type' => 'customer',
            'image' => 'images/profile/avatar.jpg',
        ]);
        $success['token'] =  $user->createToken('esmkt3m')-> accessToken; 
        return response()->json(['success'=>$success], 200); 



    }

    public function login() {
        if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){ 
            $user = Auth::User(); 
            $success['token'] =  $user->createToken('esmkt3m')-> accessToken; 
            $userApp = new User;
            $type = $userApp::where('phone',request('phone'))->value('type');
            return response()->json(['success' => $success,'type' => $type], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }

    public function details() {
    	return response()->json(Auth::User());
    }

    public function show($id) {
        if($id == Auth::id())
        {
            $owner = true;
        }else {
            $owner = false;
        }
        $user = User::where('id',$id)->first();
        return response()->json(['user' => $user, 'owner' => $owner]);
    }

    public function changeImage($id,Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'image' => 'required|image64:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        }

        $imageData = $request->get('image');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->resize(600,600)->save(public_path('images/profile/').$fileName);

        User::where('id',Auth::id())->update([
            'image' => 'images/profile/'.$fileName
        ]);
        return response()->json(['image' => 'images/profile/'.$fileName],200);
    } 
}
//
