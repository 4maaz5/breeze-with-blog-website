<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Post;
use App\Models\likes;

class LikeController extends Controller
{
    public function likehandle(Request $request,$id)
    {
        $post=Post::all();
        $like=likes::all();
        foreach ($like as $key) {
           $idd= $key->id;
        }
        $problem=new problem();
        $problem->postid=$id;
        $problem->likeid=$idd;
        $problem->save();

         $check=problem::where('postid',$id)->where('likeid',$idd)->exists();
        $count=problem::find($id);
        $likecount=problem::where('likeid',$idd)->get();
        $likess= count($likecount);
        //return $likess;
        // return $idd;
         if (!$check) {
        $likepost=new problem();
       $likepost->like_id=$idd;
       $likepost->post_id=$id;
       $likepost->save();
       return view('view',compact('id' ,'post','likess'));
        }
        else{
            return view('view',compact('id','post','likess'));
        }
    }
}
