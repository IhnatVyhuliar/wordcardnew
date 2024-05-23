@extends('layouts.cards')

@section('folder_cards')

    <div class="container w-11/12 m-auto ">
        <p class="text-2xl">Your result is {{$percentage}}%</p>
        <div class="w-full h-6 bg-gray-400 rounded-lg">
            <div class="h-6 bg-violet-500 rounded-lg" style="width:{{$percentage}}%"></div>
        </div>
        

        @if($percentage >= 75)
            <p>Great job</p>
        @elseif($percentage >= 50)
            <p>Not bad</p>
        @else
            <p>Could be better</p>
        @endif
       
        <p>{{$counts}} out of {{$number}}</p>
    </div>
    

@endsection