@extends('layouts.mainlearn')

@section('learn_section')

    
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
                
                <div class="card lg:w-5/12 w-11/12 sm:w-full ml-5 p-5 sm:p-10 h-20 mt-4 bg-white border border-gray-200 rounded-lg shadow text-black dark:bg-gray-800 dark:border-gray-700 dark:text-white" >
                    <form method="post" id="card_form" action="{{ route('learn.check') }}">
                            @csrf
                            <input type="hidden" name="folder_id" type="number" value="{{$cards['main']->folder_id}}">
                            <input type="hidden" name="value"  value="{{$card['translation']}}">
                            <input type="hidden" name="main_card_id" type="number" value="{{$cards['main']->id}}">
                            <button type="submit">
                                {{$card['translation']}}
                            </button>
                        
                    </form>
                    
                </div>
            
            @endforeach
        </div>
    </div>
    @isset($result)
    <div class="container z-1 w-[50%] max-lg:w-[92%] h-[60%]  bg-slate-100 border-2 border-grey-300 absolute top-[15%] left-[20%] max-lg:left-[5%]" >
        <div class="main p-10">
            {{ $cards["main"]->word}}
            <div class="image">
             <div class="mt-4">
                 <img src="{{Storage::url($cards["main"]->image)}}" class="w-40 h-26 rounded">
             </div>
         </div>
         @if ($result['success'])
            <div class="card text-center max-lg:w-5/12 w-12/12 max-sm:w-full  sm:p-10 h-20 mt-4 border-4 border-green-600 rounded-lg" >

                <button>
                    {{$result['input_value']}}
                </button>

                
            </div>
         @else  
         <div class="card text-center w-12/12 sm:w-full  sm:p-10 h-20 mt-4 border-4 border-red-600 rounded-lg"  >

            <button>
                {{$result['input_value']}}
            </button>

            
        </div>
        <div class="card text-center w-12/12 sm:w-full  sm:p-10 h-20 mt-4 border-4 border-green-600 rounded-lg  " >

            <button type="name">
                {{$result['correct']}}
            </button>

            
        </div>
         @endif
         
            
        <div class="card w-2/12 max-sm:w-full ml-auto  sm:p-10 h-20 mt-4 border-4 flex items-center justify-center border-grey-400 rounded-lg  " >
            <form action="{{ route('learn.proceed') }}" method="post">
                @csrf()
                <button type="submit">
                    <div type="submit" class="flex items-center space-x-4">
    
                        <div>  Next </div> <div class="h-0 w-0 border-x-8 border-x-transparent rotate-90 border-b-[16px] border-b-blue-600"></div></div>
                    </div>
        
                </button>

            </form>
            
            
        </div>
            
        
    </div>
    @endisset
    
@endsection

