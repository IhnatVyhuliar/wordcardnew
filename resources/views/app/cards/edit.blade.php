<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
            <a href="{{route('dashboard')}}" class="px-4 text-white py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">Back</a>
        </div>                
        <div class="m-2 p-2 bg-slate-100 rounded">
            
        
            <form method="POST" action='{{route('cards.update', $card->id)}}' enctype="multipart/form-data">
                @method('PUT')
                @csrf
                
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="word" id="word" value="{{$card->word}}" 
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('name') border-red-400 @enderror" 
                    placeholder=" " required />
                    <label for="word" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Word</label>
                </div>
                @error('word')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="translation" id="translation" value="{{$card->translation}}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer  @error('translation') border-red-400 @enderror" placeholder=" " required />
                    <label for="translation" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Translation</label>
                </div>
                @error('translation')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
                
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="definition" id="definition" value="{{$card->definition}}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer  @error('definition') border-red-400 @enderror" placeholder=" " required />
                    <label for="definition" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Definition</label>
                </div>
                @error('definition')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
                  <div class="relative z-0 w-full mb-6 group">
                    <img src="{{Storage::url($card->image)}}" alt="" class="w-32 h-32">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " for="image">Upload file</label>
                    <input value="{{$card->image}}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image') border-red-400 @enderror" name="image" id="image" type="file">
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">Image of card</div>

                </div>
                @error('image')
                    
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
                <input type="hidden" value='{{$card->id_folder}}' name="folder_id">
                <div class="relative z-0 w-4 mb-3"></div>
                <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Submit</button>
              </form>
              
        </div>
            

        </div>
    </div>
        
</x-app-layout>
