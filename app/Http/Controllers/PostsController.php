<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostsController extends Controller
{
    // middleware for authentication
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'search');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Shows the latest post published and paginates 3 per page
        $posts = Post::latest('created_at')->paginate(3);
        // Returns the view with the results from the variable $posts
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Display a listing of the owned Posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function showOwnPosts()
    {
        // $posts = Post::where('author', auth()->id())->latest('created_at')->paginate(3); 

        // return view('posts.showOwnposts', ['posts' => $posts]);
    }

    /**
     * Function for a simple search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        //
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
        // $this -> authorize('create', $post);

        $validated = request()->validate([
            'title' => ['required', 'min:1', 'max:255'],
            'content' => ['required', 'min:10', 'max:1000']
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['author'] = auth()->id();

        // // Get image file
        // $image = $request->file('image');
        // // Make a image name based on user name and current timestamp
        // $name = Str::slug($request->input('title')).'_'.time();
        // // Define folder path
        // $folder = '/uploads/images/';
        // // Make a file path where image will be stored [ folder path + file name + file extension]
        // $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
        // // Upload image
        // $this->uploadOne($image, $folder, 'public', $name);
        // // Set user profile image path in database to filePath
        
        // $validated['image'] = $filePath;

        $post = Post::create($validated);
        
        // redirect to the posts page
        return redirect('/')->with(['status' => 'Post successfully created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
