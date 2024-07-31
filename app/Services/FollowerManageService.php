<?php

namespace App\Services;

use App\Models\Folder_follower;

class FollowerManageService
{
    public function addFollowerToFolder(int $folder_id, int $user_id): void
    {
        if (app("folder_service")->checkDoesExists($folder_id)){
            Folder_follower::create([
                'folder_id'=>$folder_id,
                'user_id'=>$user_id,
            ]);
        }
    }

    public function deleteFollowerToFolder(int $folder_id): void
    {
        if (app("folder_service")->checkDoesExists($folder_id)){
            $folder_destroy=Folder_follower::where("folder_id", $folder_id)->first();
            $folder_destroy->delete();
        }
    }


    public function checkDoesUserFolow(int $folder_id, int $user_id): bool
    {
        if (app("folder_service")->checkDoesExists($folder_id))
        {
            return Folder_follower::where("folder_id", $folder_id)->where('user_id', $user_id)->exists();
        }
        return false;
    }


}