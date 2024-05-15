<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //retrieve all posts from the database

    public function index()
    {
        return view('createpost');
    }

    //return the view for creating a new post
    public function create()
    {

    }

    //store the newly created post

    public function store(Request $request)
    {   
        // echo "<pre>";
        // print_r($request->all());
     
        $post = new Post();
        $post->description = $request->description;

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = 'images/' . $imageName;
        }

        $post->save();

        
        //return redirect()->route('posts.view');
    }

}
