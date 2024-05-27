<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class AdminController extends Controller
{
    public function dashboard()
    {
        $posts = Post::With('user','comments.user')->get(); 
        return view('admin.index', compact('posts'));
    }
}
