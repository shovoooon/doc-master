<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function index()
    {
        return Image::select('id', 'file_path')->latest()->get();
    }


    public function store(Request $request)
    {
        $path = $request->file('image')->store('gallery', 'public');
        $image = Image::create(['file_path' => $path]);

        return response()->json(['id' => $image->id, 'url' => asset('storage/' . $path)]);
    }

    public function gallery()
    {
        return Image::latest()->get()->map(fn($img) => [
            'id' => $img->id,
            'url' => asset('storage/' . $img->file_path),
        ]);
    }
}
