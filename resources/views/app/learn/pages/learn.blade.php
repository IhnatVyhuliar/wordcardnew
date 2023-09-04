@extends('layouts.mainlearn')

@section('learn_section')
    @isset($cards)
    
    <div class="container w-100">
        <div class="main p-10">
           {{ $cards["main"]->word}}
           <div class="image">
            <div class="mt-4">
                <img src="{{Storage::url($cards["main"]->image)}}" class="w-40 h-26 rounded">
            </div>
        </div>
        </div>
        
        <div class="container top-2/4 flex flex-row flex-wrap flex-4 justify-start space-y-4 space-x-5 items-center overflow-x-hidden h-full">
            @foreach ($cards['values'] as $card)
                
                <div class="card lg:w-5/12 w-11/12 sm:w-full ml-5 p-5 sm:p-10 h-20 mt-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" value='{{$card['translation']}}' id_main="{{$cards["main"]->id}}" >
                    <form method="post" id="card_form">
                            @csrf
                            <button type="submit">
                                {{$card['translation']}}
                            </button>
                        
                    </form>
                    
                </div>
            
            @endforeach
        </div>
    </div>
    @endisset
    <script src="{{ asset('js/learncards.js') }}"></script>
@endsection

