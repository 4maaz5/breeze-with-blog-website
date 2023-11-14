<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\likes;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $imagePath = 'storage/images/' . $imageName;
        }
        $user = $request->user();
        $post = new Post;

        $post->title = $request->title;
        $post->description = $request->description;
        $post->category = $request->select;
        $post->image = $imagePath ?? null;
        // $post->likes=$one;
        $user->Post()->save($post);
        return redirect()->route('about')->with('status', "Post Added Successfully!");
    }
    public function edit($id)
    {
        $find = Post::find($id);
        if (Gate::denies('isAdmin', $find)) {
            abort(403);
        }
        return view('edit', ['find' => $find]);
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category = $request->select;
        $post->save();
        return redirect(route('dashboard'))->with('status', "Post updated Successfully!");
    }
    public function delete($id)
    {
        $likes = likes::all();
        foreach ($likes as $value) {
            $postId = $value->post_id;
        }
        if (!empty($postId)) {
            $lik = likes::where('post_id', $postId)->get();
            likes::destroy($lik);

            $comment = Comment::all();
            foreach ($comment as $key) {
                $delete = $key->post_id;
                if ($delete == $id) {
                    $data = comment::where('post_id', $delete)->get();
                    Comment::destroy($data);
                    Post::destroy($id);
                    return redirect(route('dashboard'));
                }
            }
        }
        $data = comment::where('post_id', $id)->get();
        Comment::destroy($data);
        Post::destroy($id);
        return redirect(route('dashboard'));
    }
}
