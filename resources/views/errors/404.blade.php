@extends('layouts.cards')

@section('folder_cards')
<div class="button_create lg:text-start md:justify-center">
    <a href="{{route('dashboard')}}">
        <button type="button" class="text-white bg-violet-600 focus:ring-4 hover:bg-violet-800 focus:ring-violet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Return to main</button>    
    </a>
    <div class="main_text">
        Oops, there is no page
    </div>
</div>

@endsection

