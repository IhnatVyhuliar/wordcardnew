<?php

    namespace App\Services;
    use App\Models\Folder;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    class FolderService{

        public function isOwner(Folder $folder)
        {
            return $folder->user_id==auth()->id();
        }

        public function getCards(Folder $folder)
        {
            return $folder->cards()->where('folder_id', $folder->id)->get();
        }

        public function getFollowersCount(Folder $folder)
        {
            return DB::table('folder_followers')->groupBy('folder_id')->count();
        }

        public function isFollowing(Folder $folder){
            if(Auth::user()){
                $folder_foll=DB::table('folder_followers')->where("folder_id",$folder->id)->where('user_id', Auth::user()->id)->exists();
                // dd($folder_foll);
                return  $folder_foll;
            }
            
            return false;
        }

        public function generateUniqueCode()
        {
            do {
                $code = random_int(100000, 999999);
            } while (Folder::where("code", "=", $code)->first());
      
            return $code;
        }

        public function getAccess(Folder $folder){
            $access=false;

            if($folder!=NULL){
                if(Auth::user()){
                    $owner=$folder->user_id==Auth::user();
        
                    if($owner){
                        $access=true;
                    }
                    
                }

                if($folder->status==1){
                    $access=true;
                }
                
            }
            return $access;
            
        }
    }