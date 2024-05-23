<?php

namespace App\Http\Controllers\Greece;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;


use App\Http\Requests\LaunchShowCardsRequest;
use App\Helpers\CacheHelper;
use App\Http\Requests\CheckAnswerRequest;
use Illuminate\Support\Facades\Auth;


class StudyFlashController extends Controller
{
    
    private $folder_id;
    private $folder;
    private $folder_service;
    private $folder_ser;
   //private $parent;
    
    public function Index(Folder $folder)
    {
        
        CacheHelper::Close();
        //dd($folder);
        if(isset($folder->id)){
            $this->folder_id= $folder->id;
            $learn_service=app('learn_service');
            if(Auth::user()){
                $learn_service->setfolder($this->folder_id, Auth::user()->id);
            }
            else{
                $learn_service->setfolder($this->folder_id);
            }
            $getaccess=$learn_service->getAccess();
            $folder_id=$this->folder_id;
            //dd($getaccess);
            if(!$getaccess){
                return to_route('dashboard');
            }
            
            
            $num_cards=$learn_service->getCardsNum();
            if ($num_cards%2!=0){
                $num_cards-=1;
            }
            // view("app/learn/study/cards");
            return view("app/learn/study/cards", compact('num_cards','folder_id'));
        }
        return back();
    }
    public function Launch(LaunchShowCardsRequest $request, Folder $folder){
        if (!$request->validated()){
            return back();
        }
        $request->validated();
        
        
        //$arr=[0,1,2,3];
        //dd($arr[0]);
        $learn_service=app('learn_service');
        if(Auth::user()){
            $learn_service->setfolder($folder->id, Auth::user()->id);
        }
        else{
            $learn_service->setfolder($folder->id);
        }

        $getaccess=$learn_service->getAccess();
        
        if($getaccess){
            CacheHelper::storeCache('cur_card', 0);
            //dd(CacheHelper::getVariable('cur_card'));
            //dd($request->number);
            
            CacheHelper::storeCache('number',$request->number);
            CacheHelper::storeCache('folder_id', $folder->id);
            CacheHelper::storeCache('type', intval($request->type));
            //dd($request->type);
            return $this->Handle($request->type, $request->number, $folder->id);
        }
        
        return back();
    }


    public function Proceed(Request $request){

        if(CacheHelper::getVariable('cur_card')!==NULL&&CacheHelper::getVariable('number')&&CacheHelper::getVariable('folder_id')&&CacheHelper::getVariable('type')){
            $cur_card=intval(CacheHelper::getVariable('cur_card'));
        
            $number=intval(CacheHelper::getVariable('number'));
            
            $folder_id=intval(CacheHelper::getVariable('folder_id'));
            $type=CacheHelper::getVariable('type');
            $cur_card++;
            if ($cur_card < $number){
                //dd($cur_card);
                
                //dd($cur_card);
                CacheHelper::Forget('cur_card');
                CacheHelper::storeCache('cur_card', $cur_card);
                //dd(CacheHelper::getVariable('cur_card'));
                return $this->Handle($type, $number, $folder_id);
                
            }
            else{
                $arr=CacheHelper::getVariable('check_answer');
                
                $percent=0;

                $counts = count(array_filter($arr));

                $percentage=intval($counts/($number)*100);
                CacheHelper::Close();
                return view('app.learn.pages.result', compact('percentage', 'number', 'counts'));
                
            }
            
        }
        else{
            return redirect()->route('main');
        }
    }

    private function Handle(int $type, int $cards_amount, int $folder_id){
        
        if($type == 2 && $folder_id){
            $learn_service=app('learn_service');
            
            $learn_service->setfolder(intval($folder_id));
            $cur_card=0;
            
            if(CacheHelper::getVariable('cur_card')!==NULL){
                $cur_card=CacheHelper::getVariable('cur_card');
                //dd($cur_card);
            }
            
            $cards = $this->Render($cur_card,$cards_amount, $folder_id);

            if(CacheHelper::getVariable('cards')){
                CacheHelper::forget('cards');
            }
           
            CacheHelper::storeCache('cards', $cards);
            //dd(CacheHelper::getVariable('cur_card'));
            return view('app.learn.study.cards', compact('cards'));
        }
    
    }
    private function Render(int $cur_card_num, int $cards_amount,  $folder_id){
        $learn_service=resolve('learn_service');
        $learn_service->setfolder($folder_id);
        
        $cards=resolve("compose_card_controller")->getShuffledCardArray($cur_card_num, $cards_amount,$learn_service);
        
        return $cards;
    }
}
