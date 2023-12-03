@extends('layouts.cards')

@section('folder_cards')

    <div class="container w-11/12 m-auto ">

       <p class="text-2xl">Your result is {{$percentage}}%</p>
       <p>Great job</p>
        <p>{{$counts}} out of {{$number}}</p>
    </div>
    

    @endsection