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
use Storage;
class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function getinfoByid($id){
        
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
            'code'=>$this->generateUniqueCode(),
            'user_id'=>auth()->id(),
            'favorite'=>0,
            'status'=>$request->status
        ]);
        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */

     public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Folder::where("code", "=", $code)->first());
  
        return $code;
    }
    public function show(Folder $folder)
    {
        // dd($folder->id);
        $cards = $folder->cards()->where('folder_id', $folder->id)->get();
        $folder['followers']=DB::table('folder_followers')->groupBy('folder_id')->count();
        $folder_foll=DB::table('folder_followers')->where("folder_id",$folder->id)->get();
        $folder['follow']=isset($folder_foll[0]->id);
        //$changes=is_owner($folder);
       // dd($folder[]);
        $changes=$folder->user_id==auth()->id();
        //dd($changes);
        //dd($changes);
        return view('app/folders/folders_cards', compact('folder','cards','changes'));
    }

    public function redirect_id(Request $id){
        $id_folder=$id;
        return view('app/cards/create', compact('id_folder'));
    }
    /**
     * Show the form for editing the specified resource.
     */

    protected function is_owner(Folder $folder){
       // dd($folder->user_id==auth()->id());
        return $folder->user_id==auth()->id();
    }
    public function edit(Folder $folder)
    {
       // dd($folder->name);    
       if (!$this->is_owner($folder)){
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
        if($this->is_owner($folder)){
            $folder->update($request->validated());
        }
        
        
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

    

    public function Favorite(Request $request){

        
        $folder=Folder::findOrFail($request->id);
        
        //dd($request->page);
       // dd($folder);
       // dd($folder);
        
        if($folder->favorite){
            $folder->favorite=false;
        }
        else{
            $folder->favorite=true;
        }
        $folder->update();    
        //if($id->url)
        
        if($request->page=='dashboard'){
            return to_route('dashboard');
        }
        else if($request->page=='cards'){
            /*$cards = $folder->cards()->where('folder_id', $folder->id)->get();
            return view('app/folders/folders_cards', compact('folder','cards'));*/
            return $this->show($folder);
        }
        
    }

    public static function getFolderById(int $folder_id){
        return Folder::find($folder_id);
    }
}
