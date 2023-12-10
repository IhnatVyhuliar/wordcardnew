<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WordCard') }}</title>
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="wordcard, languages, flashcards, words, card, word, card word, cards, studying, folders, flash, every, any, way to learn, learn, learning languages, english, polish, deutsch, german, ukrainian, chinese, korean, definition, translation">
        <meta name='author' content="Ihnat Vyhuliar">
        <meta name="description" content="Wordcard - your way to learn languages, flashcards and folders. Platform for studying every language">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />    
        <link rel="shortcut icon" href="{{Storage::url('public/cards/wordcard.png')}}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen mx-auto bg-gray-100 object-center">
            @if ( Auth::user()!=NULL)
                @include('layouts.navigation')
            @else 
                @include('layouts.navigation2')
            @endif
            

            <!-- Page Heading -->
            

            <!-- Page Content -->
            <main>
                
                {{ $slot }}
            </main>
        </div>
    </body>
   
</html>
