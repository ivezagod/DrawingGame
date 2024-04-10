<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrawingBoard;

class CanvasImageController extends Controller
{
    public function save(Request $request)
    {


        $drawingBoard = new DrawingBoard();
        $drawingBoard->image = $request->input('image');
        $drawingBoard->title = $request->input('title');
        $drawingBoard->url = $request->input('url');



        $drawingBoard->save();

        return redirect()->back();
    }
}


