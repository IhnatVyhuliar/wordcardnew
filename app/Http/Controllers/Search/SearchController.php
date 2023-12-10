<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Folder_follower;
use DB;
use App\Models\Searchquery;
class SearchController extends Controller
{
    public function Index(){
        $popular_queries=Searchquery::orderByDesc('number')->where('number', '>', 2)->limit(5)->get();
        $base_url=$url = url('/search/find/');
        //dd($popular_queries);
        return view('app/search/index', compact('popular_queries', 'base_url'));
    }

    public function FindFolders(Request $request){
        $folders=[];
        if(!$request->keyword==''){
            $keyword=$request->keyword;
            return to_route('search.show', compact('keyword'));
        }
        else{

            return to_route('search.index');
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
            if(sizeof($folders)!=0){
                foreach ($folders as $folder){
                    $folder_query_name=$folder->name;
                    $exist= Searchquery::where('query', '=', $folder_query_name)->exists();
                    if ($exist){
                        $query=Searchquery::where('query', '=', $folder_query_name)-> first();
                        if (intval($query->number+1)>=8388607){
                            $query->number=intval($query->number);
                            $query->update();
                        }
                        else{
                            $query->number=intval($query->number+1);
                            $query->update();
                        }
                        
                    }
                    else{
                        Searchquery::create([
                            'query'=>$folder_query_name,
                            'number'=>1
                        ]);
                    };
                    }
                
                
            }
            foreach($folders as $folder){
                //$cards=Card::where('folder_id', $folder->id)->get();
                $status=DB::table('folder_followers')->where('folder_id',$folder->id)->where('user_id',auth()->id())->first();
                
                $cards = $folder->cards()->where('folder_id', $folder->id)->select('word','translation','definition','image', 'id')->take(7)->get();
                $folder['cards']=$cards;
                $folder['followers']=DB::table('folder_followers')->where('folder_id', $folder->id)->groupBy('folder_id')->count();
                $folder['follow']=isset($status->id);
                    
                
                //dd(isset($status[0]->id));
                //$bool=DB::table('folder_followers')->where('folder_id',$folder->id)->where('user_id',auth()->id())->get();
                //print_r(!(NULL==$bool));
            }
        }
        else{
            return to_route('search.index');
        }       
        return $folders;
    }
}
