<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Folder_follower;
use DB;
class SearchController extends Controller
{
    public function Index(){
        return view('app/search/index');
    }

    public function FindFolders(Request $request){
        $folders=[];
        if(!$request->keyword==''){
            $keyword=$request->keyword;
            return to_route('search.show', compact('keyword'));
        }
    }

    public function ShowFolders(Request $request){
        //dd($request->keyword);
        $folders= $this->findByKeyword($request->keyword);
        return view('app/search/index', compact('folders')); 
    }

    protected function findByKeyword($keyword){
        $folders=[];
        //dd($keyword);
        if($keyword!=''){
            $folders=Folder::where('code', 'like', "%".$keyword."%")->orWhere('name', 'like', "%".$keyword."%")->where('status', 1)->select('name','code', 'id')->orderBy('created_at')->take(2)->get();
            //dd($folders);
            foreach($folders as $folder){
                //$cards=Card::where('folder_id', $folder->id)->get();
                $status=DB::table('folder_followers')->where('folder_id',$folder->id)->where('user_id',auth()->id())->get();
                
                $cards = $folder->cards()->where('folder_id', $folder->id)->select('word','translation','definition','image', 'id')->take(7)->get();
                $folder['cards']=$cards;
                $folder['followers']=DB::table('folder_followers')->where('folder_id', $folder->id)->groupBy('folder_id')->count();
                $folder['follow']=isset($status[0]->id);
                    
                
                //dd(isset($status[0]->id));
                //$bool=DB::table('folder_followers')->where('folder_id',$folder->id)->where('user_id',auth()->id())->get();
                //print_r(!(NULL==$bool));
            }
        }       
        return $folders;
    }
}
