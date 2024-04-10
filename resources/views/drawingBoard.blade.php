<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-bgImage">
<div class="bg-blue-100">
 <h2 class="text-center text-blue-500 text-3xl">{{$title}}</h2>

</div>
<section class="container relative left-[120px] top-[50px] w-[100px]">
    <div id="toolbar">
        <h1>DrawIt</h1>
        <label for="stroke">Colour</label>
        <input id="stroke" name='stroke' type="color">
        <label for="lineWidth">Line Width:</label>
        <input id="lineWidth" name='lineWidth' class="text-black" type="range" min="1" max="100" value="5">
        <span id="lineWidthValue">5</span>
        <button id="eraser" class="toggle-btn eraser-button">Eraser</button>
        <button id="clear">Clear</button>
        <p>Players:</p>
{{--                @foreach($players as $player)--}}
{{--                    <p>{{$player->user_name}}</p>--}}
{{--                @endforeach--}}


        <form id="save-form" action="{{ route('canvas-image-save') }}" method="POST">
            @csrf
            <input type="hidden" name="title" id="drawing-board-title" value="{{ $title }}">
            <input type="hidden" name="image" id="canvas-image-data">
            <input type="hidden" name="url" value="{{ $url }}">
            <button type="submit">Save image</button>
        </form>

    </div>
    <div>
        <canvas id="drawing-board" class=" bg-white w-[1100px] relative "></canvas>
    </div>
</section>
<script src="/resources/js/app.js"></script>
</body>
</html>



