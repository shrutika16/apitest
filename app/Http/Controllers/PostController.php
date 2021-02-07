<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\PostMedia;

class PostController extends Controller
{
    public function create_post(Request $request)
    { 
        //check user token
        $user = Auth::user();
        
        //validation
        $validator = $this->validator($request->all());
       
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        //check there is any one content is avilable

        //content type is text
        $post = new post;
        $post->Content = $request->Content_text;
        $post->user_id = $user->id;
        $post->save();

        //content type is image/video
        if($request->hasFile('Content_media')) 
        {
            $allowedfileExtension=['mp4','jpg','png','bmp'];
            $errors = [];
            
            foreach ($request->Content_media as $file) 
            {   
                
                $extension = $file->getClientOriginalExtension();
                
                $media_type = 'image';
                if($extension == 'mp4')
                {
                    $media_type = 'video';
                }
        
                $check = in_array($extension,$allowedfileExtension);
                
                if($check) 
                {
                        $name = $file->getClientOriginalName();

                        $file->move(public_path() .'/posts/', $name);

                        //store in db
                        $post_media = new PostMedia;
                        $post_media->post_id = $post->id;
                        $post_media->media_type = $media_type;
                        $post_media->Media_content = public_path() . '/posts/' . $name;
                        $post_media->save();
                       
                } else {
                    return response('invalid_file_format', 422);
                }
            }
        }

        return response('Post Uploaded Successfully', 200);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Content_text' => ['required_without_all:Content_media', 'string', 'max:255'],
            'Content_media.*' => ['required_without_all:Content_text']
        ]);
    }
}
