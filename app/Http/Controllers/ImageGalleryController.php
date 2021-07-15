<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageGallery;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;

class ImageGalleryController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = ImageGallery::where('id', '!=', 1)->get();
        $firstImage = ImageGallery::get()->first();
    	return view('image-gallery', compact('pictures', 'firstImage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, ImageGallery $picture)
    {
        $validated = request()->validate([
    		'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            $validated['image'] = $filePath;
        }
        $picture = ImageGallery::create($validated);

    	return back()->with(['status' => 'Image Uploaded successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ImageGallery::find($id)->delete();
        
    	return back()->with(['status' => 'Image Removed successfully!']);	
    }
}
