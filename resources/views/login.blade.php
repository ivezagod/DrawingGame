<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"  href="/images/pencil.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15+Charted&family=Jersey+25&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-bgImage4 backdrop-blur-sm h-screen w-screen font-first">
<div class="max-w-container mx-auto " >
    <h1 class="text-center text-pink-600 py-[50px] text-4xl font-bold" >
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

            <button type="submit" class="bg-transparent hover:bg-pink-600 hover:text-black  rounded-md text-pink-600 border border-pink-600 py-2 px-4 mb-10">Make new board</button>
        </form>
    </div>
</div>
</body>
</html>


