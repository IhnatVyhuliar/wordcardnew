@extends('layouts.cards')

@section('folder_cards')
<div class="flex flex-col">
  <form action="{{route('search.find')}}" method="get">
    <div class="flex w-full flex-wrap items-stretch">
      @csrf()
        <input
        type="search"
        id='search'
        name='keyword'
        class=" m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
        placeholder="Search"
        aria-label="Search"
        aria-describedby="button-addon1" />
  
      <!--Search button-->
      <button
        class=" flex items-center rounded-r bg-violet-400 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
        type="submit"
        id="button-addon1"
        data-te-ripple-init
        data-te-ripple-color="light">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          class="h-5 w-5">
          <path
            fill-rule="evenodd"
            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
            clip-rule="evenodd" />
        </svg>
      </button>
      
    </form>
      
    </div>
    
        
        
        @isset($popular_queries, $base_url)

        <div id="list_key " class="container mt-3 p-4">
            <ul class="list-disc"><p class="text-lg "><i>Most popular queries</i></p>
            @foreach($popular_queries as $query)
                <p><li><i><a href="{{$base_url}}/{{$query->query}}" class=" text-violet-800">{{$query->query}}</a></i></li></p>
            @endforeach
            </ul>
        </div>
        @endisset
        
   
      
    </div>
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
@endsection


