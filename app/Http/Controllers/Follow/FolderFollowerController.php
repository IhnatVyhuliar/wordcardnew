<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder_follower;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderFollowerController extends Controller
{
    public function FollowAndUnfollowFolder(Request $request)
    {
        $request->validate([
            'folder_id' => ['required']
        ]);

        $this->ToggleSubscriptionToFolder(
        $request->folder_id,
        $request->user()->id
        );

        return back();
    }

    private function ToggleSubscriptionToFolder(int $folder_id, int $user_id)
    {
        if(!app("folder_manage_service")->checkDoesUserFolow($folder_id, $user_id))
        {
            $this->AddFollowerToFolder($folder_id, $user_id);
        }
        else{
            $this->DeleteFollowerToFolder($folder_id, $user_id);
        }
    }

    private function AddFollowerToFolder(int $folder_id, int $user_id)
    {
        app("folder_manage_service")->addFollowerToFolder($folder_id, $user_id);
    }

    private function DeleteFollowerToFolder(int $folder_id, int $user_id)
    {
        app("folder_manage_service")->deleteFollowerToFolder($folder_id, $user_id);
    }


    public function getFollows(){
        if (Auth::user()){
            $folders=Folder::where("folder_followers.user_id", Auth::user()->id)->leftJoin('folder_followers', 'folders.id', '=', 'folder_followers.folder_id')->select('folders.id', 'folders.name', 'folders.code', 'folders.status')->get();
           
            foreach($folders as $folder){
                $status=Folder_follower::where('folder_id',$folder->id)->where('user_id',auth()->id())->get();
                $cards = $folder->cards()->where('folder_id', $folder->id)->select('word','translation','definition','image', 'id')->get();
                $folder['cards']=$cards;
                $folder['followers']=Folder_follower::groupBy('folder_id')->where("folder_id", $folder->id)->count();
                $folder['follow']=isset($status[0]->id);       
            }
            return view('app.favorite.index', compact('folders'));
        }
        else{
            return to_route('main');
        }
    }
}
