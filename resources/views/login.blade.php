<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"  href="/images/pencil.svg">
    @vite('resources/css/app.css')
</head>
<body class="bg-bgImage4 backdrop-blur-sm h-screen w-screen">
<div class="max-w-container mx-auto " >
    <h1 class="text-center text-pink-600 py-[50px] text-4xl">
        Draw It
    </h1>
    <div class="max-w-[300px] mx-auto border border-pink-600 rounded-lg  ">
        <h2 class="text-pink-600 my-5 text-center  text-xl">
            Start Game
        </h2>
        <form action="{{ route('drawingBoard.store') }}" method="post" enctype="multipart/form-data" class="flex justify-center gap-10 flex-col  items-center">
            @csrf
            <div class="flex flex-col  ">
                <label for="Title" class=" text-pink-600">Title</label>
                <input type="text" class="py-2 bg-transparent text-pink-600 active:border-pink border border-pink-600 rounded-md text-black pl-[10px] bg-none" name="title" id="title">
            </div>

            <button type="submit" class="bg-transparent  rounded-md text-pink-600 border border-pink-600 py-2 px-4 mb-10">Make new board</button>
        </form>
    </div>
</div>
</body>
</html>


