<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class dataController extends Controller
{
    public function store(Request $request)
    {
        // Validate the image file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
        ]);

        // Handle the uploaded image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // Optionally, you can store the path in a database or return it
            // Example: Image::create(['path' => $imagePath]);

            return back()->with('success', 'Image uploaded successfully')->with('image', $imagePath);
        }

        return back()->with('error', 'No image uploaded');
    }
}
