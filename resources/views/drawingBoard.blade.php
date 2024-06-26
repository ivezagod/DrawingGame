<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon"  href="/images/pencil.svg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15+Charted&family=Jersey+25&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <title>DrawIt-{{$url}}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>
<body class="bg-bgImage4    w-screen bg-black font-first">

<h2 class="text-center text-pink-600 font-bold text-5xl mt-[70px]  ">{{$title}}</h2>
    <section class="container items-center flex-col-reverse lg:flex-row flex mx-auto mt-[30px]  ">

        <div id="toolbar" class="bg-transparent border border-pink-600 text-center items-center lg:justify-center  rounded-md p-5 flex flex-row lg:flex lg:flex-col float-left shadow-blue">
            <h1 class="text-pink-600 hidden lg:block">DrawIt</h1>
            <div class="flex flex-col lg:mr-0 text-center mr-10">
                <label for="stroke" class="text-pink-600">Colour</label>
                <input id="stroke" class="  bg-transparent" name='stroke' type="color">
                <label for="lineWidth" class="text-pink-600">Line Width:</label>
                <input id="lineWidth" name='lineWidth'class="range pr-6 accent-pink-600" type="range" min="1" max="100" value="5">
                <span id="lineWidthValue" class="text-pink-600">5</span>
            </div>
            <div class="flex flex-col lg:mx-0 mx-10">
                <button id="eraser" class="toggle-btn bg-transparent border border-pink-600 text-pink-600 rounded-md eraser-button ">Eraser</button>
                <button id="clear" class="mt-2 bg-transparent border border-pink-600 text-pink-600 rounded-md   px-4  hover:bg-pink-600 hover:text-white">Clear</button>
            </div>
{{--            <form id="save-form" action="{{ route('canvas-image-save') }}" method="POST" class="mt-2">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="title" id="drawing-board-title" value="{{ $title }}">--}}
{{--                <input type="hidden" name="image" id="canvas-image-data">--}}
{{--                <input type="hidden" name="url" value="{{ $url }}">--}}
{{--                <button type="submit" class="border border-green-500 text-green-500 rounded-md px-4 py-2 hover:bg-green-600 hover:text-white">Save image</button>--}}
{{--            </form>--}}
            <div class="flex flex-col lg:ml-0 ml-10">
                <button id="download-image-btn" class="mt-2 border border-blue-500 text-blue-500 rounded-md px-4 py-2 hover:bg-blue-600 hover:text-white">Download image</button>

                <a href="{{route('welcome')}}" class="mt-4 text-pink-600 hover:underline">Go back</a>
            </div>
        </div>



        <div class="max-w-[1100px] w-full m-0 lg:ml-10   mx-auto">
            <canvas id="drawing-board" class="bg-white w-full border border-pink-600   rounded-md" ></canvas>
        </div>






    </section>



</body>
</html>



