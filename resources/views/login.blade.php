<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-200">
<div class="max-w-container mx-auto " >
    <h1 class="text-center py-[50px] text-4xl">
        Draw It
    </h1>
    <div class="max-w-[300px] mx-auto bg-pink-300 rounded-lg border ">
        <h2 class="text-white my-5 text-center  text-xl">
            Start Game
        </h2>
        <form action="{{ route('drawingBoard.store') }}" method="post" enctype="multipart/form-data" class="flex justify-center gap-10 flex-col  items-center">
            @csrf
            <div class="flex flex-col  ">
                <label for="Title" class="text-white">Title</label>
                <input type="text" class="py-2 rounded-md text-black pl-[10px]" name="title" id="title">
            </div>

            <button class="bg-white  rounded-md text-black bg-purple-900 py-2 px-4 mb-10">Make new board</button>
        </form>
    </div>
</div>
</body>
</html>


