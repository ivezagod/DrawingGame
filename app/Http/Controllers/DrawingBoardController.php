<?php

namespace App\Http\Controllers;

use App\Events\DrawingUpdated;
use App\Models\DrawingBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DrawingBoardController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
        ]);


        $url = Str::random(10);


        while (DrawingBoard::where('url', $url)->exists()) {
            $url = Str::random(10);
        }

        $drawingBoard = new DrawingBoard();
        $drawingBoard->title = $request->title;
        $drawingBoard->url = $url;
        $drawingBoard->save();

        return redirect()->route('drawingBoard.show', ['url' => $url]);
    }

    public function show($url)
    {
        // Retrieve the drawing board based on the URL
        $drawingBoard = DrawingBoard::where('url', $url)->firstOrFail();

        // Pass the drawing board's title to the view
        $title = $drawingBoard->title;


        return view('drawingBoard', ['title' => $title,'url'=>$url]);
    }



}




