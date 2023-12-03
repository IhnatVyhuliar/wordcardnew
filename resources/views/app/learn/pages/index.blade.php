@extends('layouts.cards')

@section('folder_cards')
<div class="container">
    <div class="mb-2">
        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 ">Choose type</h5>
    </div>
    
    <div class="container flex flex-wrap ">

        <div class="max-w-sm p-6 mt-6 mr-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            
            
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Select numbers of cards</h5>
            
            <p class="mb-3 text-base font-normal text-gray-500 dark:text-gray-400">Number of cards </p>
            
            <form action="flash" method="post">
                @csrf()
                <input type="hidden" name="type" value="1">
                <div class="flex flex-col space-y-2 p-2 w-80">
                    @if($num_cards%2!=0)
                    <input type="number" name="number" id="number_cards_in" min="2" step="2" max="{{$num_cards}}" value="{{$num_cards-1}}"  class="block py-2.5 px-0 w-2/4 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <input type="range" class="w-full" id='number_range' name="range" min="2" max="{{$num_cards}}" step="2" value="{{$num_cards}}" />
                    
                    @else
                    <input type="number" name="number" id="number_cards_in" min="2" step="2" max="{{$num_cards}}" value="{{$num_cards}}-1"  class="block py-2.5 px-0 w-2/4 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <input type="range" class="w-full" id='number_range' name="range" min="2" max="{{$num_cards}}" step="2" value="{{$num_cards}}-1" />
                    
                    
                    @endif
                    
                    <input type="hidden" name="folder_id" value="{{$folder_id}}">
                    
                </div>

                <button type="submit" class="text-white bg-violet-600 focus:ring-4 hover:bg-violet-800 focus:ring-violet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-8 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Start</button>    
            </form>
        </div>
        <div class="max-w-sm p-6 mt-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            
            
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Select correct answer</h5>
            
            <p class="mb-3 text-base font-normal text-gray-500 dark:text-gray-400">Number of cards </p>
            
            <form action="" method="post">
                @csrf()
                <input type="hidden" name="type" value="1">
                <div class="flex flex-col space-y-2 p-2 w-80">
                    <input type="number" name="number" id="number_cards_in" min="2" step="2" max="{{$num_cards}}" value="{{$num_cards}}"  class="block py-2.5 px-0 w-2/4 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <input type="range" class="w-full" name="range" id='number_range' min="2" max="{{$num_cards}}" step="2" value="{{$num_cards}}" />
                    </ul>
                </div>

                <button type="submit" class="text-white bg-violet-600 focus:ring-4 hover:bg-violet-800 focus:ring-violet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-8 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Start</button>    
            </form>
        </div>
        
    </div>
</div>


  @endsection

  