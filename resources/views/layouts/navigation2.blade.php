<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{Storage::url('public/cards/wordcard.png')}}">
    
    <title>WordCard</title>
</head>

<body>
    <header class="w-full h-16  drop-shadow-lg">
        <div class="container px-4 md:px-0 h-full mx-auto flex justify-between items-center">
            <!-- Logo Here -->
            <a class="text-yellow-400 text-xl font-bold italic" href="{{route('main')}}">
                
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                
            </a>

            <!-- Menu links here -->
            <ul id="menu" class="hidden fixed top-0 right-0 px-10 py-16  z-50  flex  flex-col gap-8 text-3xl
                md:relative md:flex md:p-0 md:bg-transparent text-black bg-gray-700 md:flex-row md:space-x-6">

                <li class="md:hidden z-90 fixed top-4 right-6">
                    <a href="javascript:void(0)" class="text-right text-black text-4xl"
                        onclick="toggleMenu()">&times;</a>
                </li>
                <li>
                    <a class="text-black  max-md:text-white opacity-80 text-lg hover:opacity-100 duration-300" href="{{route('login')}}">Login</a>
                </li>
                <li>
                    <a class="text-black  max-md:text-white text-lg opacity-80 hover:opacity-100 duration-300" href="{{route('register')}}">Register</a>
                </li>
                <li>
                    <a class="text-black max-md:text-white text-lg opacity-80 hover:opacity-100 duration-300" href="{{route('search.index')}}">Search</a>
                </li>
                </li>
            </ul>

            <!-- This is used to open the menu on mobile devices -->
            <div class="flex items-center md:hidden">
                <button class="text-black text-4xl font-bold opacity-70 hover:opacity-100 duration-300"
                    onclick="toggleMenu()">
                    &#9776;
                </button>
            </div>

    </header>

    
    <!-- Javascript Code -->
    <script>
        var menu = document.getElementById('menu');

        function toggleMenu() {
            menu.classList.toggle('hidden');
            menu.classList.toggle('w-full');
            menu.classList.toggle('h-screen');
        }
    </script>
</body>

</html>