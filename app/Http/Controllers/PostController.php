<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Session;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $posts= Post::orderBy('id','asc')->paginate(5);
        return view('posts.index',compact('posts'));








        
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|alpha_dash|min:5|max:255',
            'body'=>'required'
        ]);
        $post=new Post();
        $post= Post::create([
			'title'=>$request->title,
            'slug'=>$request->slug,
			'body'=>$request->body
            ]);
            $post->save();
            //session::flash('key','value');
            Session::flash('success','The blog post has been successfully saved!');
            return redirect()->route('posts.show',$post->id);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::findOrFail($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::findOrFail($id);
        return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post= Post::findOrFail($id);
        if($request->input('slug')== $post->slug){

            $request->validate([
                'title'=>'required|max:255',
                'body'=>'required'
            ]);
        }else{

            $request->validate([
                'title'=>'required|max:255',
                'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body'=>'required'
                ]);
            }

       $post = Post::find($id);
		$post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
		$post->save();

        Session::flash('success','This post was successfully saved.');
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::findOrFail($id);
		$post->delete();
        return redirect()->route("posts.index");
    }
}
