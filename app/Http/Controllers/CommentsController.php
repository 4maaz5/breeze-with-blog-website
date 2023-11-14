<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $data = Post::find($id);
        $var = $data->id;
        $comment = new Comment();
        $comment->post_id = $var;
        $comment->comment = $request->comment;
        $id = Auth::user()->id;
        $comment->user_id = $id;
        $comment->save();
        return response()->json(['contact'=>'Thanks for commenting, We appreciate your comment!']);
        // return redirect(route('view', $var))->with(['message' => 'Thanks for commenting, We appreciate your comment!']);
    }
    public function display(Request $request, $id)
    {
        $comment = Post::find($id);
        $idd = $comment->id;
        $iddd = $comment->user_id;
        $store = Comment::where('post_id', $idd)->get();
        $user = User::all();
        return view('comments', compact('store', 'user', 'iddd'));
    }
    public function trash($id)
    {
        $comment = Comment::all();
        foreach ($comment as $key) {
            $idd = $key->id;
        }
        $logedUser = Auth::user()->id;
        if ($logedUser == $id) {
            $store = Comment::destroy($idd);
            return view('comments', compact('store'));
        } else {
            // $message="You Cannot delete this comment.";
            return view('comments')->with('message', 'You Cannot delete this comment.');
        }
    }
}
