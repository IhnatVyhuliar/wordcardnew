<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Card;
use App\Models\Card\Folder_follower;
use DB;
class ApiController extends Controller
{
    public function showdata(Request $request){
        $folders=[];
        if(!$request->keyword==''){
            $keyword=$request->keyword;
            $folders=Folder::where('code', 'like', "%".$keyword."%")->orWhere('name', 'like', "%".$keyword."%")->where('status', 1)->select('name','code', 'id')->orderBy('created_at')->take(2)->get();
            foreach($folders as $folder){
                //$cards=Card::where('folder_id', $folder->id)->get();
                $cards = $folder->cards()->where('folder_id', $folder->id)->select('word','translation','definition','image')->take(7)->get();
                $folder['cards']=$cards;
                $folder['followers']=DB::table('folder_followers')->groupBy('folder_id')->count();
            }
        }   
        return $folders;
        
    }

    public function findData(Request $request){
        $folders=[];
        if(!$request->keyword==''){
            $keyword=$request->keyword;
            $folders=Folder::where('code', 'like', "%".$keyword."%")->orWhere('name', 'like', "%".$keyword."%")->where('status', 1)->select('name','code')->orderBy('created_at')->take(2)->get();
            /*foreach($folders as $folder){
                //$cards=Card::where('folder_id', $folder->id)->get();
                $cards = $folder->cards()->where('folder_id', $folder->id)->select('word','translation','definition','image')->take(7)->get();
                $folder['cards']=$cards;
                $folder['followers']=DB::table('folder_followers')->groupBy('folder_id')->count();
            }*/
        }   
        return $folders;
        
    }
}
