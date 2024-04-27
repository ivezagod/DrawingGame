<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrawingBoard;
use Illuminate\Support\Facades\Storage;

class CanvasImageController extends Controller
{


    public function downloadImage(Request $request)
    {
        // Get the base64 encoded image data from the request
        $imageData = $request->input('image');

        // Remove the "data:image/png;base64," prefix from the base64 string
        $imageData = str_replace('data:image/png;base64,', '', $imageData);

        // Convert base64 to binary data
        $imageData = base64_decode($imageData);

        // Generate a unique filename
        $filename = 'drawing_' . time() . '.png';

        // Save the image to the storage directory
        Storage::disk('public')->put($filename, $imageData);

        // Get the URL of the saved image
        $imageUrl = Storage::disk('public')->url($filename);

        return response()->json(['url' => $imageUrl]);
    }
}


