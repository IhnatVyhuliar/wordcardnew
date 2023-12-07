@extends('layouts.cards')

@section('folder_cards')
    <div class="container flex flex-col" >
        <p class="text-2xl">Users: {{$count}}</p>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Admin
                            </th>
                            
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$user->name}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$user->email}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{$user->admin}}
                            </th>
                            
                            
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

       
    </div>
   
@endsection