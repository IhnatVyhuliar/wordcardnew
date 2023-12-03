@extends('layouts.cards')

@section('folder_cards')

    <div class="container w-11/12 m-auto ">

       <p class="text-2xl">Your result is {{$percentage}}%</p>
       <p>Great job</p>
        <p>{{$number+1}} out of {{$counts}}</p>
    </div>
    

    @endsection