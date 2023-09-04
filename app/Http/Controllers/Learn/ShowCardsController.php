<?php

namespace App\Http\Controllers\Learn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LaunchShowCardsRequest;
use App\Providers\FolderLearnServiceProvider;
use App\Helpers\ExternalApiHelper;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Learn\Data\FolderDataController;
use App\Http\Requests\CheckAnswerRequest;
class ShowCardsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    private $folder_id;
    private $folder;
    private $folder_service;
    private $folder_ser;
   //private $parent;
    
    public function Index(Request $request)
    {
        if(isset($request->folder_id)){
            $this->folder_id=$request->folder_id;
            Cache::put('id', $this->folder_id); 
            

            $this->folder_service= new FolderLearnServiceProvider($this->folder_id, auth()->id());
            
            Cache::put('folder_service', $this->folder_service); 
            //app(ExternalApiHelper::class($folder_id));
            
           // dd($this->folder_service);
            //dd($this->folder_service->getAccess());
            $getaccess=$this->folder_service->getAccess();
            $access=$getaccess['access'];
            //dd($access);
            if(!$access){
                return to_route('dashboard');
            }
            
            
            $num_cards=$this->folder_service->getCardsNum();
            
            return view('app.learn.pages.index', compact('num_cards'));
        }
    }
    public function Launch(LaunchShowCardsRequest $request){
        $request->validated();


        Cache::put('type', $request->type);

        $this->folder_id=Cache::get('id', $this->folder_id);
        $this->folder_service= Cache::get('folder_service');
        $this->permissions=$this->folder_service->getAccess();
        $this->cards_amount=$this->folder_service->getCardsNum();
        if($this->permissions['access']){
            Cache::put('cur_card', 0);
            return $this->handle($request->type,$permissions=$this->permissions, $this->cards_amount);
        }
        
    }
   private function handle(int $type, array $permissions, int $cards_amount){
        $this->card_amount=$cards_amount;
        if($type==1){
            $this->cur_card=Cache::get('cur_card');
            //dd($this->cur_card);
            $cards=$this->render($this->cur_card,$this->card_amount);
           // dd($cards['values']);
            /*foreach($cards['values'] as $card){
                dd($card['translation']);
            } */
           return view('app.learn.pages.learn', compact('cards'));
        }
        else{
            
        }
   }
   private function render(int $cur_card_num, int $cards_amount){
    //dd($this->folder_service);
    $this->folder_service=Cache::get('folder_service');
    return $this->folder_service->getCard($cur_card_num, $cards_amount);
   }

    public function CheckAnswer(CheckAnswerRequest $request){
        $request->validated();
        $this->folder_service=Cache::get('folder_service');
        $arr_response=$this->folder_service;
    }
    public function Close(){
        Cache::flush();
    }
}
