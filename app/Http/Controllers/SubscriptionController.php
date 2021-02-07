<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Subscription;

class SubscriptionController extends Controller
{
    public function process(Request $request, $action){
        //Auth user
        $user = Auth::user();
        
        // validation
        $validator = $this->validator($request->all());
       
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        if($action === 'follow'){
            $follow = $this->follow($request->all(), $user);

            return response($follow, 200); 
        }

        if($action === 'unfollow'){
            $this->unfollow($request->all(), $user);

            return response('Unfollow successfully', 200);
        }

        return  response('Please Provide Action', 422);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'to_user_id' => ['required'],
        ]);
    }

    public function follow($request , $user){
        $follow = new Subscription;
        $follow->from_user_id = $user->id;
        $follow->to_user_id = $request['to_user_id'];
        $follow->save();

        return $follow;
    }

    public function unfollow($request , $user){
        $unfollow = Subscription::where('to_user_id', $request['to_user_id'])
            ->where('from_user_id' , $user->id)
            ->delete();

        return true;
    }
}
