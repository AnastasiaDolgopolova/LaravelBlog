<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id',Auth::user()->id)->paginate(3);
        return view('user.posts', ['posts' => $posts]);
    }

    public function create()
    {
        $tags = Tag::pluck('title', 'id')->all();
        $categories = Category::pluck('title', 'id')->all();
        return view('user.create_post', compact(
            'categories',
            'tags'
        ));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'image' => 'nullable|image'
        ]);
        
        $post = Post::add($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleStatus($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('my_posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        //dd($post->date);
        $tags = Tag::pluck('title', 'id')->all();
        $categories = Category::pluck('title', 'id')->all();
        $selectedTags = $post->tags->pluck('id')->all();
        
        return view('user.edit_post', compact(
            'categories',
            'tags',
            'post',
            'selectedTags'
        ));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'image' => 'nullable|image'
        ]);

        $post = Post::find($id);

        $post->edit($request->all());

        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleStatus($request->get('status'));
        $post->toggleFeatured($request->get('is_featured'));

        return redirect()->route('my_posts.index');
    }

    public function toggleStatus($id)
    {
        $post = Post::find($id);
        $post->toggleStatus();

        return redirect()->back();
    }

    public function toggleFeatured($id)
    {
        $post = Post::find($id);
        $post->toggleFeatured();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Post::find($id)->remove();

        return redirect()->route('my_posts.index');
    }
}
