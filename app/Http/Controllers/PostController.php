<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{
    public function Cards(Request $request){
        return Post::latest()->get();
    }
    public function Post(Request $request){
        $validated = $request -> validate([
            'cardcontent' => 'required',
        ]);


        // 주소 분리
        $url = $request->imagename;
        $part_url = explode('/',$url,5);

        $post = new Post;
        $post -> user_id = Auth::id();
        $post -> user_name = Auth::user()->name;
        $post -> comment = $request -> cardcontent;
        $post -> photo = $part_url[2];
        $post -> save();
    }

    public function store(Request $request){
        $validated = $request -> validate([
            'file' => 'required|max:255',
        ]);
        $path = $request ->file("file") -> store('/public/images');
        return $path;
    }
    public function show($post_id){
        $post = Post::find($post_id);
        return Inertia::render('Instagram/DetailCard',['post' => $post]);
    }
    public function updatecard(Request $request,$post_id){

        // 주소 분리

        if($request->imagename != ""){
            $url = $request->imagename;
            $part_url = explode('/',$url,5);
        }
        //update
        $post = Post::findOrFail($post_id);
        $post -> user_id = Auth::id();
        $post -> user_name = Auth::user()->name;
        $post -> comment = $request -> cardcontent;
        if($request->imagename != ""){
            $post -> photo = $part_url[2];
        }
        $post -> save();

        return $post;

    }
    public function update(Request $request){
        $path = $request ->file("file") -> store('/public/images');
        return $path;
    }
    public function delete($post_id){
        $post = Post::findOrFail($post_id);
        $url = $post -> photo;
        if($url != "null.jpg"){
            $imagePath = "/public/images/$url";
            Storage::delete($imagePath);
        }
        $post->delete();
    }
}
