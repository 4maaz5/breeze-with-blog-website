<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\likes;
use App\Models\User;
use App\Models\Contact;
use App\Models\Problem;
use Illuminate\Support\Facades\Gate;

class ShowController extends Controller
{
    public function index()
    {
        return view('about');
    }
    public function view($id)
    {
        $post = Post::find($id);
        $var = 1;
        $userId = $post->id;
        $data = likes::where('like_count', $var)->where('post_id', $userId)->get();
        $counted = count($data);
        return view('view', compact('counted', 'post'));
    }
    public function sport()
    {
        $post = post::all();
        return view('sport', ['post' => $post]);
    }
    public function users()
    {
        $users = User::all();
        if (Gate::denies('isAdmin', $users)) {
            return redirect('/');
        } else {
            $user = Auth::user();
            return view('users', compact('users', 'user'));
        }
    }
    public function travel()
    {
        $post = Post::all();
        return view('travel', ['post' => $post]);
    }
    public function politics()
    {
        $post = Post::all();
        return view('politics', ['post' => $post]);
    }
    public function contact()
    {
        return view('contact');
    }
    public function contactSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();
        return response()->json(['contact' => 'Thanks for contacting us..... We will respond you soon.']);
    }
    public function trend()
    {
        $post = Post::all();
        return view('trend', ['post' => $post]);
    }
    public function check()
    {
        if (Auth::check()) {
            return "You are authecticated user";
        }
        return "you are not authenticated";
    }
    public function like(Request $request, $id)
    {
        $post = Post::find($id);
        $postid = $post->id;

        $user_id = $post->user_id;
        $post_id = $post->id;

        $like = new likes();
        $count = 1;
        $like->like_count = $count;

        $check = likes::where('post_id', $post_id)->exists();
        $checktwo = likes::where('dislike_count', $user_id)->exists();

        if (!$check && !$checktwo) {
            $like = new likes();
            $count = 1;
            $like->post_id = $post->id;
            $like->like_count = $count;
            $like->dislike_count = $user_id;
            $like->save();
            return view('view', ['post' => $post]);
        } else if ($check && !$checktwo) {
            $like = new likes();
            $count = 1;
            $like->post_id = $post->id;
            $like->like_count = $count;
            $like->dislike_count = $user_id;
            $like->save();
            return view('view', ['post' => $post]);
        } else if (!$check && $checktwo) {
            $like = new likes();
            $count = 1;
            $like->post_id = $post->id;
            $like->like_count = $count;
            $like->dislike_count = $user_id;
            $like->save();
            return view('view', ['post' => $post]);
        } else {
            return view('view', ['post' => $post]);
        }
    }
    public function update(Request $request)
    {
        $data = ['message' => 'Post Liked'];
        if (Gate::denies('isAdmin', $data)) {
            return view('dashboard');
        } else {
            return response()->json($data);
        }
    }
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function display(Request $request)
    {
        $data = Post::paginate(5);
        if (Gate::denies('isAdmin', $data)) {
            // $userid=$request->user()->id;
            // $data=Post::where('user_id',$userid)->get();
            return view('dashboard', ['data' => $data]);
            // return view('dashboard');
        } else {
            // $userid=$request->user()->id;
            // $data=Post::where('user_id',$userid)->get();
            return view('dashboard', ['data' => $data]);
        }
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $find = Post::where('title', $search)->orwhere('category', $search)->get();
        $user = User::where('name', $search)->get();
        // return $user;
        return view('search', compact('find', 'user'));
    }

    public function processButton(Request $request)
    {
        sleep(2);

        return response()->json(['message' => 'Button clicked']);
    }
}
