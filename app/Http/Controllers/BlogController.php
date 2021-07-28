<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;

class BlogController extends Controller
{
    public function getSingle(Request $request, $slug){
        
        $post =  Post::where('slug',$slug)->firstOrFail();

        return view('blog.single',compact('post'));
    }
public function getIndex(){
    $posts= Post::orderBy('id','asc')->paginate(5);
        return view('blog.index',compact('posts'));
}
public function getwel(){

    $posts= Post::orderBy('id','asc')->paginate(5);
    return view('pages.welcome',compact('posts'));
}


}