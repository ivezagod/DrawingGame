<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrawingBoard;
use Illuminate\Support\Facades\Storage;

class CanvasImageController extends Controller
{


    public function downloadImage(Request $request)
    {

        $imageData = $request->input('image');

        $imageData = str_replace('data:image/png;base64,', '', $imageData);


        $imageData = base64_decode($imageData);


        $filename = 'drawing_' . time() . '.png';


        Storage::disk('public')->put($filename, $imageData);


        $imageUrl = Storage::disk('public')->url($filename);

        return response()->json(['url' => $imageUrl]);
    }
}


