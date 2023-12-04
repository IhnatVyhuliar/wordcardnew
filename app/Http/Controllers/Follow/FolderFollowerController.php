<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Folder\FolderController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder_follower;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderFollowerController extends Controller
{
    public function Follower(Request $request){

        $request->validate([
            'folder_id' => ['required'],
            'page'=>['required']
        ]);

        $folder_foll=Folder_follower::where("folder_id", '=', $request->folder_id)->where('user_id', '=', auth()->id())->first();
        $folder_id=$request->folder_id;
       // dd($folder_foll);
        if(!isset($folder_foll->id)){

            Folder_follower::create([
                'folder_id'=>$request->folder_id,
                'user_id'=>auth()->id(),
            ]);
        }
        else{
            $folder_destroy=Folder_follower::find($folder_foll->id);
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

    public function getFollows(){
        if (Auth::user()){
            $folders=Folder::where("folder_followers.user_id", Auth::user()->id)->leftJoin('folder_followers', 'folders.id', '=', 'folder_followers.folder_id')->select('folders.id', 'folders.name', 'folders.code', 'folders.status')->get();
           
            foreach($folders as $folder){
                //$cards=Card::where('folder_id', $folder->id)->get();
                $status=Folder_follower::where('folder_id',$folder->id)->where('user_id',auth()->id())->get();
               // dd($folder->id);
                $cards = $folder->cards()->where('folder_id', $folder->id)->select('word','translation','definition','image', 'id')->get();
                //dd($cards);
                $folder['cards']=$cards;
                $folder['followers']=Folder_follower::groupBy('folder_id')->count();
                $folder['follow']=isset($status[0]->id);
                    
                
                //dd(isset($status[0]->id));
                //$bool=DB::table('folder_followers')->where('folder_id',$folder->id)->where('user_id',auth()->id())->get();
                //print_r(!(NULL==$bool));
            }
            
            return view('app.favorite.index', compact('folders'));
        }
        else{
            return to_route('main');
        }
    }
}
