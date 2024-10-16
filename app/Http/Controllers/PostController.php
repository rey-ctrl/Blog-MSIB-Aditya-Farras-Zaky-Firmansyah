<?php

namespace App\Http\Controllers;

use App\Models\Post; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // This method will show posts page
    public function index() {
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('posts.list', [
            'posts' => $posts
        ]);
    }

    // This method will show create post page
    public function create() {
        return view('posts.create');
    }

    // This method will store a post in db
    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:5',
            'category' => 'required|string|min:5',
            'description' => 'required',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('posts.create')->withInput()->withErrors($validator);
        }

        // Here we will insert post in db
        $post = new Post();
        $post->name = $request->name;
        $post->category = $request->category;
        $post->description = $request->description;
        $post->save();

        if ($request->image != "") {
            // Here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // Unique image name

            // Save image to posts directory
            $image->move(public_path('uploads/posts'), $imageName);

            // Save image name in database
            $post->image = $imageName;
            $post->save();
        }        

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // This method will show edit post page
    public function edit($id) {
        $post = Post::findOrFail($id);
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    // This method will update a post
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'category' => 'required|string|min:5',
            'description' => 'required',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('posts.edit', $post->id)->withInput()->withErrors($validator);
        }

        // Here we will update post
        $post->name = $request->name;
        $post->category = $request->category;
        $post->description = $request->description;
        $post->save();

        if ($request->image != "") {
            // Delete old image if exists
            if ($post->image) {
                File::delete(public_path('uploads/posts/' . $post->image));
            }

            // Here we will store new image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // Unique image name

            // Save image to posts directory
            $image->move(public_path('uploads/posts'), $imageName);

            // Save new image name in database
            $post->image = $imageName;
            $post->save();
        }        

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // This method will delete a post
    public function destroy($id) {
        $post = Post::findOrFail($id);

        // Delete image if exists
        if ($post->image) {
            File::delete(public_path('uploads/posts/' . $post->image));
        }

        // Delete post from database
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}