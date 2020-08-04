<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Validator;
use App\Post;

class PostController extends Controller
{
    public function index(){
        
        if(auth()->user()->userHasRole('admin')){
            $posts = Post::all()->sortByDesc('created_at');
        }else{
            $posts = auth()->user()->posts()->get()->sortByDesc('created_at');
        }

        return view('admin.posts.index',['posts' => $posts]);
    }

    public function show(Post $post){
        return view('blog-post', ['post' => $post]);
    }

    public function create(){
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    public function store(){
        $this->authorize('create', Post::class);
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        Session::flash('alert-created', 'Post was created');

        return redirect()->route('post.index');
    }

    public function edit(Post $post){

        $this->authorize('view',$post);
        return view('admin.posts.edit',['post' => $post]);
    }

    public function destroy(Post $post){
        $this->authorize('delete',$post);
        $post->delete();

        Session::flash('alert-deleted', 'Post was deleted');

        return back();
    }

    public function update(Post $post){
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update',$post);
        $post->save();

        Session::flash('alert-updated', 'Post was updated');

        return redirect()->route('post.index');
        
    }
}

