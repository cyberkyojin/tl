<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index() {
        $user = auth()->user();

        if($user == null) {
            $user = ['id' =>':/'];
        }

        $posts = Post::all();

        return view('index', compact('posts', 'user'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:50',
            'files' => 'required|mimes:gif,png,jpg,jpeg|between:4,33000'
        ]);

        $post = new Post;

        $post->title = $request->title;

        if($request->file('files')->isValid()) {

            $requestFile = $request->file('files');

            $extension = $requestFile->extension();

            $fileName = md5($requestFile->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestFile->move(public_path('files'), $fileName);

            $post->file = $fileName;
    
        }
        $user = auth()->user();

        $post->user_id = $user->id;

        $post->user_name = $user->name;

        $post->save();

        return redirect('/')->with('msg', 'Post created.');
    }

    public function destroy($id) {
        Post::findOrFail($id)->delete();

        return redirect('/')->with('danger_msg', 'Post deleted.');
    }
}
