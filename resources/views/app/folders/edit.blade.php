<x-app-layout>
     
        
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
            <a href="{{route('dashboard')}}">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button>    
            </a>
            
        </div>                
        <div class="m-2 p-2  rounded">
            
        
            <form method="POST" action="{{route('folders.update', $folder->id)}}"  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="name" id="name_category"  value={{$folder->name}} class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('name') border-red-400 @enderror" placeholder=" " required />
                    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6" >Folder name</label>
                </div>
                @error('name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
                
                
                <div class="relative z-0 w-full mb-6 group">    
                    <div class="mt-1 text-sm text-gray-500 dark:text-black" id="user_avatar_help">Status</div>
                    <select  id='status' name='status' class='form-multiselect w-full mt-1 @error('status') border-red-400 @enderror'>
                        
                        @foreach(App\Enums\FolderStatus::cases() as $status)
                        <option value="{{$status->value}}" {{ $folder->status == $status->value ? 'selected' : '' }}>{{$status->name}}</option>
                    @endforeach
                    </select>
                    
                    <input type="hidden" name="id" value="{{$folder->id}}">
                <div class="relative z-0 w-4 mb-3"></div>
                <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Submit</button>
              </form>
              
        </div>
            

        </div>
    </div>
        

</x-app-layout>