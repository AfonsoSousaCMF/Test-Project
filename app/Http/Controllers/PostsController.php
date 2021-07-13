<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;

class PostsController extends Controller
{
    use UploadTrait;

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
     * Function for a simple search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:3'
        ]);

        $search = request('search');

        if($search != "") {
            $posts = Post::where("title", 'LIKE', '%' .$search. '%')->paginate(3);
            
            if(count($posts) > 0) {
                return view('posts.index', [ 'posts' => $posts])->withDetails($posts)->withQuery($search);
            }else{
                return view('posts.index', [ 'posts' => $posts])->withDetails($posts)->withQuery($search);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $validated = request()->validate([
            'title' => ['required', 'min:1', 'max:255'],
            'content' => ['required', 'min:10', 'max:1000'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required',
        ]);

        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('title')).'_'.time();
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $imagePath = $filePath;
        }

        //$validated['author_id'] = Auth::user()->id;
        //$post = Post::create($validated);
        $data = [
            'title' => $request->get('title'),
            'content'  => $request->get('content'),
            'image' => $imagePath,
            'author_id' => Auth::user()->id,
        ];
        $post = Post::create($data);
 
        if($post)
        {        
            $tagNames = explode(", ", $request->get('tags'));
            $tagIds = [];
            foreach($tagNames as $tagName)
            {
                //$post->tags()->create(['name'=>$tagName]);
                //Or to take care of avoiding duplication of Tag
                //you could substitute the above line as
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                if($tag)
                {
                    $tagIds[] = $tag->id;
                }

            }
            $post->tags()->sync($tagIds);
        }
        
        // redirect to the posts page
        return back()->with(['status' => 'Post successfully created!']);
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
        $post = Post::findOrFail($id);
        // $tags = Tag::where('author_id', $post->id)->paginate(5);
        $tagsList = $post->tags;
        $tags = '';
        foreach($tagsList as $index => $tag) {
            $tags .= $index === 0 ? $tag->name : ', '.$tag->name;
        }
 
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $id)
    {
        $post = Post::findOrFail($id);
        $this -> authorize('update', $post);

        $validated = request()->validate([
            'title' => ['required', 'min:1', 'max:255'],
            'content' => ['required', 'min:10', 'max:1000'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required',
        ]);

        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('title')).'_'.time();
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set image path in database to filePath
            $validated['image'] = $filePath;
        }

        if($post)
        {        
            $tagNames = explode(", ", $request->get('tags'));
            $tagIds = [];
            foreach($tagNames as $tagName)
            {
                //$post->tags()->create(['name'=>$tagName]);
                //Or to take care of avoiding duplication of Tag
                //you could substitute the above line as
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                if($tag)
                {
                    $tagIds[] = $tag->id;
                }

            }
            $post->tags()->sync($tagIds);
        }
        $post->update($validated);
        // $post->tags()->sync($request->input('tags'));
        
        // redirect to the posts page
        return redirect('/home')->with(['status' => 'Post successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this -> authorize('update', $post);

        $post->delete();
        
        return back()->with(['status' => 'Post successfully deleted!']);
    }
}
