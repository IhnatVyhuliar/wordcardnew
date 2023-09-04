<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Folder\FolderController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder_follower;
use App\Models\Folder;
class FolderFollowerController extends Controller
{
    public function follower(Request $request){

        $request->validate([
            'folder_id' => ['required'],
            'page'=>['required']
        ]);

        $folder_foll=Folder_follower::where("folder_id",$request->folder_id)->get();
        $folder_id=$request->folder_id;

        if(!isset($folder_foll[0]->id)){

            Folder_follower::create([
                'folder_id'=>$request->folder_id,
                'user_id'=>auth()->id(),
            ]);
        }
        else{
            $folder_destroy=Folder_follower::find($folder_foll[0]->id);
            $folder_destroy->delete();    
        }
        //dd($request->page);
        if($request->page=='search'){
            $folder=Folder::find($request->folder_id);
            $keyword=$folder->name;
            return to_route('search.find', compact('keyword'));
        }
        else if($request->page=='cards'){
            $folder_controller=new FolderController();
            $folder=Folder::find($request->folder_id);
            return $folder_controller->show($folder);
        }
    }
}
