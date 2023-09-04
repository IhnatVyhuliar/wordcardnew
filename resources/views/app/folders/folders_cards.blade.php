@extends('layouts.folders')

@section('folder_cards')

   <div class="container space-y-3 p-5">
    
        <div class="folder_name ">
           Folder name: {{$folder->name}}
        </div>
        <div class="code">
            <span class="text-xs">Code  {{strval($folder->code)}}</span>
        </div>
        <div class="edit flex space-x-4">
            @if($changes)
            <div class="favorite">
                <form action="{{route('folder.favorite')}}" method="post">
                    @csrf()
                    <input type="hidden" name="id" value="{{$folder->id}}">
                    <input type="hidden" name="page" value="cards">
                    <button type="submit">
                        @if($folder->favorite)
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_179_59)">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_179_59">
                            <rect width="24" height="24" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>
                        @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_179_59)">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_179_59">
                            <rect width="24" height="24" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>
                        @endif()
                    </button>
    
                   
                
                
                </form>
            </div>
            <div class="edit">
                <a href="{{ route('folders.edit',$folder->id)}}">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5525 3.56224H3.55249C3.02206 3.56224 2.51335 3.77295 2.13828 4.14803C1.7632 4.5231 1.55249 5.03181 1.55249 5.56224V19.5622C1.55249 20.0927 1.7632 20.6014 2.13828 20.9765C2.51335 21.3515 3.02206 21.5622 3.55249 21.5622H17.5525C18.0829 21.5622 18.5916 21.3515 18.9667 20.9765C19.3418 20.6014 19.5525 20.0927 19.5525 19.5622V12.5622" stroke="#8666C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.0525 2.06224C18.4503 1.66441 18.9899 1.44092 19.5525 1.44092C20.1151 1.44092 20.6547 1.66441 21.0525 2.06224C21.4503 2.46006 21.6738 2.99963 21.6738 3.56224C21.6738 4.12485 21.4503 4.66441 21.0525 5.06224L11.5525 14.5622L7.55249 15.5622L8.55249 11.5622L18.0525 2.06224Z" stroke="#8666C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></a>
                
            </div>
                
            </a>
            <div class="delete ">
                <form 
                    action="{{route('folders.destroy', $folder->id)}}" method="post" 
                onsubmit="return confirm('Are you sure, the whole cards will be destroyed?');" >
                @csrf
                @method('DELETE')
                    <button type="submit"><svg width="24" height="24" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.25 4.5H3.75H15.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.25 4.5V15C14.25 15.3978 14.092 15.7794 13.8107 16.0607C13.5294 16.342 13.1478 16.5 12.75 16.5H5.25C4.85218 16.5 4.47064 16.342 4.18934 16.0607C3.90804 15.7794 3.75 15.3978 3.75 15V4.5M6 4.5V3C6 2.60218 6.15804 2.22064 6.43934 1.93934C6.72064 1.65804 7.10218 1.5 7.5 1.5H10.5C10.8978 1.5 11.2794 1.65804 11.5607 1.93934C11.842 2.22064 12 2.60218 12 3V4.5" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 8.25V12.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.5 8.25V12.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></button>
                </form>
                
            </div>
            
    </div>
    @else
    
        <form action="{{route('search.follow')}}" method="post">
            @csrf()
            <input type="hidden" name="folder_id" value="{{$folder->id}}">
            <input type="hidden" name="page" value="cards">
        @if($folder->follow)
            <button type="submit" class="text-black border-2 border-orange-400 hover:border-orange-300 focus:ring-orange-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Unfollow </button>
        @else
        <button type="submit" class="text-black border-2 border-secondary  hover:border-orange-300 focus:ring-orange-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Follow + </button>
            @endif

        </form>
        
        
        
    </a>
            @endif
            <div class="learn">
                <a href="{{route('learn.index',$folder->id)}}">
                    <button type="button" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Learn</button>
                </a>
                
            </div>
                
                
        
            @if(!$folder->status)
                <p>Private</p>
            @else
                <p>Public</p>
            @endif
            

    </div>
    
    
    <div class="container  flex flex-row flex-wrap flex-4 justify-start  space-x-5 lg:space-y-4 md:space-y-8 ">
    @foreach ($cards as $card)
    <div class="w-72  h-60 border-4 border-gray-200 rounded-xl mt-4 ml-5 flex flex-col p-2 overflow-y-auto relative">
        <div class="word flex justify-between">
            <div class="word"> {{$card->word}}</div>
            <div class="edit flex space-x-3">    
                @if($changes) 
                <div class="favorite">
                    <form action="{{route('cards.favorite')}}" method="POST">
                        @csrf()
                            <input type="hidden" name="id" value="{{$card->id}}">
                            <input type="hidden" name="folder_id" value="{{$card->folder_id}}">
                            <input type="hidden" name="page" value="cards">
                            <button type="submit">
                                @if($card->favorite)
                                <svg width="20" height="20" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8459 1.87012L14.9359 8.13012L21.8459 9.14012L16.8459 14.0101L18.0259 20.8901L11.8459 17.6401L5.66595 20.8901L6.84595 14.0101L1.84595 9.14012L8.75595 8.13012L11.8459 1.87012Z" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @else
                                <svg width="20" height="20" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8459 1.87012L14.9359 8.13012L21.8459 9.14012L16.8459 14.0101L18.0259 20.8901L11.8459 17.6401L5.66595 20.8901L6.84595 14.0101L1.84595 9.14012L8.75595 8.13012L11.8459 1.87012Z" stroke="grey" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endif
                            </button>
                    </form>

                    
                        
                </div>
               
                <div class="edit">
                <a href="{{ route('cards.edit',$card->id)}}">
                    <svg width="20" height="20" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5525 3.56224H3.55249C3.02206 3.56224 2.51335 3.77295 2.13828 4.14803C1.7632 4.5231 1.55249 5.03181 1.55249 5.56224V19.5622C1.55249 20.0927 1.7632 20.6014 2.13828 20.9765C2.51335 21.3515 3.02206 21.5622 3.55249 21.5622H17.5525C18.0829 21.5622 18.5916 21.3515 18.9667 20.9765C19.3418 20.6014 19.5525 20.0927 19.5525 19.5622V12.5622" stroke="#1D4ED8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.0525 2.06224C18.4503 1.66441 18.9899 1.44092 19.5525 1.44092C20.1151 1.44092 20.6547 1.66441 21.0525 2.06224C21.4503 2.46006 21.6738 2.99963 21.6738 3.56224C21.6738 4.12485 21.4503 4.66441 21.0525 5.06224L11.5525 14.5622L7.55249 15.5622L8.55249 11.5622L18.0525 2.06224Z" stroke="#1D4ED8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></a>
                

            </div>
                

                @endif
                @if($changes)
                <div class="delete ">
                    <form action="{{route('cards.destroy', $card->id)}}" method="post" onsubmit="return confirm('Are you sure, the whole cards will be destroyed?');">
                        @method('DELETE')
                        @csrf()
                        <button type="submit">
                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 4.5H3.75H15.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14.25 4.5V15C14.25 15.3978 14.092 15.7794 13.8107 16.0607C13.5294 16.342 13.1478 16.5 12.75 16.5H5.25C4.85218 16.5 4.47064 16.342 4.18934 16.0607C3.90804 15.7794 3.75 15.3978 3.75 15V4.5M6 4.5V3C6 2.60218 6.15804 2.22064 6.43934 1.93934C6.72064 1.65804 7.10218 1.5 7.5 1.5H10.5C10.8978 1.5 11.2794 1.65804 11.5607 1.93934C11.842 2.22064 12 2.60218 12 3V4.5" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.5 8.25V12.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.5 8.25V12.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </button>
    
                    </form>
                    
                </div>
                @else
                
                @endif
               
            
            

        </div>
        </div>
       
        
        <div class="word flex justify-end">
            <img src="{{Storage::url($card->image)}}" class="w-20 h-18 rounded">
        </div>
        
        <div class="flex">
            <p id='demo_def{{$card->id}}' class="" style="display: none">{{$card->definition}}</p>     
            <button id='button_def{{$card->id}}' onclick="showTranslation('demo_def{{$card->id}}','button_def{{$card->id}}')" >Show definition</button>
            
        </div>
        
        <div class="flex justify-between">
            <p id='demo_trans{{$card->id}}' class="" style="display: none">{{$card->translation}}</p>   
            <button id='button_trans{{$card->id}}' onclick="showTranslation('demo_trans{{$card->id}}','button_trans{{$card->id}}')" >Show translation</button>
            
        </div>
        <div class="botton  absolute bottom-2 right-4">
            
            <span>{{$card->level * 25}}</span>
        </div>

    </div>
        
      
    @endforeach

    @if($changes)
    <div class="w-72  h-60 bg-zinc-300 rounded-xl flex items-center justify-center mt-4">
               
        <a href="{{ route('cards.create', ['folder_id'=>$folder->id])}}">
            <button type="button" class="text-white  bg-violet-500 focus:ring-4 hover:bg-violet-700 focus:ring-violet-500 font-medium rounded-lg text-sm px-5 py-2.5  mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 ">Add new card</button>    </a>
        </a>
    </div>
            
    @endif
    
    </div>
    
</div>


@endsection

<Script>
     
     function showTranslation(demoId, buttonId) {
        //alert(demoId);
        let demoElement = document.getElementById(demoId);
        let buttonElement = document.getElementById(buttonId);
        if (demoElement.style.display =='block'){
            buttonElement.classList.remove('ml-4');
            demoElement.style.display='none'
            buttonElement.innerHTML='show';
            
        }
        else{
            buttonElement.classList.add('ml-4');
            
            demoElement.style.display = 'block';
            buttonElement.innerHTML='<svg width="16" height="16" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.75 2.25L2.25 6.75" stroke="#0038FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2.25 2.25L6.75 6.75" stroke="#0038FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        }
        //buttonElement.style.display = 'none';
    }
</Script>