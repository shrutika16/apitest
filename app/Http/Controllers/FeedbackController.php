<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Feedback;
use App\Comment;

class FeedbackController extends Controller
{
    public function process(Request $request, $action){
        
        //Auth user
        $user = Auth::user();
        
        // validation
        $validator = $this->validator($request->all());
       
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        // on like create
        if($action === 'like'){

            $like = $this->like($request->all(), $user);
            
            if($like == false){
                return response('Alredy Liked Post', 200);
            }
            return response('Like Post', 200);
        }

        //on dislike delete
        if($action === 'dislike'){

            $dislike = $this->dislike($request->all(), $user);

            return response('Dislike Post', 200);

        }

        //on comment create
        if($action === 'comment'){
            $comment = $this->comment($request->all(), $user);
            return response($comment, 200);
        }

        return  response('Please Provide Action', 422);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'post_id' => ['required'],
        ]);
    }

    public function like($request , $user){
        $feedback = feedback::where('post_id', $request['post_id'])
            ->where('user_id' , $user->id)
            ->get();
        
        if($feedback->isEmpty()){
            $feedback = new feedback;
            $feedback->post_id = $request['post_id'];
            $feedback->user_id = $user->id;
            $feedback->save();
            return $feedback;
        }

       return false;
    }

    public function dislike($request , $user){

        $dislike = feedback::where('post_id', $request['post_id'])
            ->where('user_id' , $user->id)
            ->delete();

        return true;
    }

    public function comment($request , $user){

        $comment = new comment;
        $comment->post_id = $request['post_id'];
        $comment->user_id = $user->id;
        $comment->comment = $request['comment'];
        $comment->save();
        
        return $comment;
    }

}
