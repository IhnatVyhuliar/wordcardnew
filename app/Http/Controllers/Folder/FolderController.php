<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FolderStoreRequest;
use App\Services\FolderService;
use Storage;
class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function getinfoByid($id)
    {
        $folders=Folder::where('user_id', $id)->get();
        return $folders;
        
    }

 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app/folders/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'digits:1', 'max:1'],
            'id'=>['required']
        ]);
        Folder::create([
            'name'=>$request->name,
            'code'=>resolve('folder_service')->generateUniqueCode(),
            'user_id'=>auth()->id(),
            'favorite'=>0,
            'status'=>$request->status
        ]);
        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */


    public function show(Folder $folder)
    {

        $cards = resolve('folder_service')->getCards($folder);
        $folder['followers']=resolve('folder_service')->getFollowersCount($folder);
        $folder['follow']=resolve('folder_service')->isFollowing($folder);
        $changes=resolve('folder_service')->isOwner($folder);

        return view('app/folders/folders_cards', compact('folder','cards','changes'));
    }

    public function redirect_id(Request $id){
        $id_folder = $id;
        return view('app/cards/create', compact('id_folder'));
    }
    /**
     * Show the form for editing the specified resource.
     */


    public function edit(Folder $folder, )
    {

       if (!resolve('folder_service')->isOwner($folder)){
        return to_route('search.index');
       }
       else{
        return view('app/folders/edit', compact('folder'));
       }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FolderStoreRequest $request, Folder $folder)
    {

        $request->validated(); 
        $folder->name=$request->name;
        $folder->status=$request->status;
        $folder->update();
        
        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
       // Storage::delete($folder->image);
        $folder->delete();
        
        return to_route('dashboard');
    }

    

    public function Favorite(Folder $folder){
        // dd($folder);
        if($folder->favorite){
            $folder->favorite=false;
        }
        else{
            $folder->favorite=true;
        }
        $folder->update();    
        //if($id->url)
        
       return back();
        
    }

    public static function getFolderById(int $folder_id){
        return Folder::find($folder_id);
    }
}
