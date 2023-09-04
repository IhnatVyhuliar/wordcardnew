<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Folder\FolderController;
class IndexController extends Controller
{
    public function index(){
        $id=auth()->user()->id;
        $folder_class=new FolderController;
        $folders=$folder_class->getinfoByid($id);
        $folders_cards=[];
        $cards=[];
        foreach($folders as $folder){
            //dd($folder->cards());
            $cards = $folder->cards()->where('folder_id', $folder->id)->take(7)->get();
            //dd($cards);
            $folders_cards[$folder->name] = $cards;
        }
        return view('dashboard', compact('folders_cards','folders'));
        
    }
}
