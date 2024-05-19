<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    //retrieve all posts from the database

    public function index()
    {
        $posts = Post::all();
        return view('viewpost',['posts'=>$posts]);

    }

    //return the view for creating a new post
    public function create()
    {
        return view('createpost');
    }

    //store the newly created post

    public function store(Request $request)
    {   
        // echo "<pre>";
        // print_r($request->all());
     
        $post = new Post();
        $post->description = $request->description;
        $post->user_id = Auth::id();
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = 'images/' . $imageName;
        }

        $post->save();

        
        return redirect('/view');
    }

    public function view()
    {
       
        $user = Auth::user();
         $posts = Post::with('comments.user')->get();
        
        return view('viewpost',['user' => $user,'posts'=>$posts]);

    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id!==Auth::id()){
            return redirect()->back()->with('error','You are not authorized to edit this post.');
        }
        return view('editpost',compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id!==Auth::id()){
            return redirect()->back()->with('error','You are not authorized to update this post');
        }
        $request->validate([
            'description'=>'nullable|max:255',
        ]);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success','Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id!==Auth::id()){
            return redirect()->back()->with("error",'You are not authorized to delete this post.');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success','Post deleted successfully.');
    }

}
