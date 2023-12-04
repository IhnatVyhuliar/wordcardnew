@extends('layouts.cards')

@section('folder_cards')

    <div class="container w-11/12 m-auto ">
        
        @if(sizeof($folders)==0)
            <h4>You don't have any follows</h4>
        @endif
        @isset($folders)
    
        @foreach ($folders as $folder)
        <div class="folder_container_main  rounded-md bg-white shadow-md z-0 p-4 max-h-[470px]  overflow-y-scroll lg:max-h-[470px] md:max-h-[250px] ">
            
            <div class="container flex flex-row flex-wrap flex-4 justify-start space-x-4 space-y-4 items-center  overflow-x-hidden">        
            <div class="flex space-x-4 flex-wrap">
                
                <div class="folder_name ">
                    {{$folder->name}}
                </div>
                <div class="code ">
                    <span class="text-xs">#{{strval($folder->code)}}</span>
                    
                    
                </div>
                
            <div class="explore">
                <a href="{{route('folders.show',$folder->id)}}">
                    <button type="button" class="text-white bg-violet-500 focus:ring-4 hover:bg-violet-700 focus:ring-violet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Explore</button>
                </a>
                <a href="{{route('learn.index',$folder->id)}}">
                    <button type="button" class="text-white bg-violet-500 focus:ring-4 hover:bg-violet-700 focus:ring-violet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Learn</button>
                </a>
            </div>
            <div class="explore">
                
                    <form action="{{route('search.follow')}}" method="post">
                        @csrf()
                        <input type="hidden" name="folder_id" value="{{$folder->id}}">
                        <input type="hidden" name="page" value="search">
                    @if($folder->follow)
                        <button type="submit" class="text-black border-2 border-orange-400 hover:border-orange-300 focus:ring-orange-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Unfollow </button>
                    @else
                    <button type="submit" class="text-black border-2 border-secondary  hover:border-orange-300 focus:ring-orange-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Follow + </button>
                        @endif

                    </form>
                    
                    
            </div>
            <div class="flex">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.3413 22.6586C17.8642 22.6586 22.3413 18.1814 22.3413 12.6586C22.3413 7.13572 17.8642 2.65857 12.3413 2.65857C6.81846 2.65857 2.34131 7.13572 2.34131 12.6586C2.34131 18.1814 6.81846 22.6586 12.3413 22.6586Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.34131 12.6586H22.3413" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.3413 2.65857C14.8426 5.39692 16.2641 8.9506 16.3413 12.6586C16.2641 16.3665 14.8426 19.9202 12.3413 22.6586C9.84003 19.9202 8.41856 16.3665 8.34131 12.6586C8.41856 8.9506 9.84003 5.39692 12.3413 2.65857Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    
                    {{strval($folder->followers)}}
            </div>

            <span class="text-lg"> </span>
            </div>
            
            <div class="container  flex flex-row flex-wrap flex-4 justify-start space-x-5 lg:space-y-4 md:space-y-4 items-start">
            @foreach ($folder['cards'] as $card)
                <div class="w-60  h-52 max-h-52 border-4 border-gray-200 rounded-xl mt-4 ml-5 flex flex-col p-2 overflow-y-auto ">
                    <div class="word flex justify-between">
                        <div class="word"> {{$card->word}}</div>
                    </div>

                    <div class="word flex justify-end">
                        <img src="{{Storage::url($card->image)}}" class="w-24 h-20 rounded">
                    </div>
                    
                    <div class="flex">
                        <p id='demo_def{{$card->id}}' class="" style="display: none">{{$card->definition}}</p>     
                        <button id='button_def{{$card->id}}' onclick="showTranslation('demo_def{{$card->id}}','button_def{{$card->id}}')" >Show definition</button>
                        
                    </div>
                    
                    <div class="flex justify-between">
                        <p id='demo_trans{{$card->id}}' class="" style="display: none">{{$card->translation}}</p>   
                        <button id='button_trans{{$card->id}}' onclick="showTranslation('demo_trans{{$card->id}}','button_trans{{$card->id}}')" >Show translation</button>
                        
                    </div>
                    <div class="botton flex justify-end">
                        <span>{{$card->level * 25}}</span>
                    </div>
        
                </div>
                
            
            @endforeach
        
            
            </div>
            
        </div>
        
        </div>
        @endforeach
    @endisset
  </div>
  
  <script>
    var $= (id)=> document.getElementById(id);
        //alert($("search"));

        function showTranslation(demoId, buttonId) {
       //alert(demoId);

       let demoElement = document.getElementById(demoId);
       let buttonElement = document.getElementById(buttonId);
       if (demoElement.style.display =='block'){
           buttonElement.classList.remove('ml-2');
           demoElement.style.display='none'
           buttonElement.innerHTML='show';
           
       }
       else{
           buttonElement.classList.add('ml-2');
           
           demoElement.style.display = 'block';
           buttonElement.innerHTML='<svg width="16" height="16" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.75 2.25L2.25 6.75" stroke="#0038FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2.25 2.25L6.75 6.75" stroke="#0038FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
       }
       //buttonElement.style.display = 'none';
   }
        

   

        //$("search").addEventListener("onsubmit", keyUpp);
      

  </script>
    </div>
    

@endsection