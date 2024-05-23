
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 folders_container container space-y-10">
            <div class="container text-right mr-4">
                <form action="{{route('learn.close', $cards['main']->folder_id)}}" method="post">
                    @csrf()
                    
                    <button type="submit"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.1069 6.14282L6.10693 18.1428" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.10693 6.14282L18.1069 18.1428" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </button>
                </form>
            </div>
            
            <div class="container">
                @yield('learn_section')
            </div>
            
            
            
            </div>
           
        
    </div>



</x-app-layout>