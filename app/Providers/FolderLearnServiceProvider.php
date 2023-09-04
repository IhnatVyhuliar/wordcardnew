<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Folder;
use Illuminate\Support\Arr;
use App\Http\Resources\CardsResource;
class FolderLearnServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    private $folder_id;
    private $folder;
    private $user_id;
    public function __construct($folder_id,$user_id){
        $this->folder_id = $folder_id;
    //dd($folder_id);
        $this->user_id=$user_id;
        $this->folder=Folder::find($this->folder_id);
    }

    public function getAccess(){
        $access=false;
        //dd($this->folder);
        $owner=$this->folder->user_id==$this->user_id;
       // dd($owner);
        if($owner){
            $access=true;
            
        }

        else if($this->folder->status==1){
            $access=true;
        }
        return ['owner'=>$owner,'access'=>$access];
    }

    

    public function getFolder(){
        return $this->folder;
    }

    public function getCardsNum(){
        $cards_num=$this->folder->cards()->where('folder_id', $this->folder->id)->count();
        return $cards_num;
    }

    public function getCard(int $cur_card_num, int $cards_amount){
        $card=$this->folder->cards()->where('folder_id', $this->folder->id)->get();
        $cur_card=$card[$cur_card_num];
        //dd($cur_card['id']);
        $cur_card_id=$cur_card['id'];
        $cards['main']=$cur_card;
        $cards_values=$this->getCardOptions($cur_card_id, $cards_amount);
        $main_option=$cur_card->toArray();
        array_push($cards_values, $main_option);
        $cards_values=Arr::shuffle($cards_values);
        $cards['values']=$cards_values;
        return $cards;

    }
    public function getCardOptions($cur_card_id, $cards_amount){
        $translation_options=$this->to_array($this->folder->cards()->select('translation')->where('folder_id', $this->folder->id)->where('id', '!=', $cur_card_id)->get());
        
        $arr_options=[];

        if($cards_amount<=4){
            $arr_options=Arr::random($translation_options,1);
            
        }
        else if($cards_amount>4){
            $arr_options=Arr::random($translation_options,3);
        }
        return $arr_options;
    }
   
    public function to_array($collection){
        $arr = [];
        foreach ($collection as $card) {
            array_push($arr,$card->toArray()); // Assuming Card model has an toArray() method
        }
        return $arr;
    
    }
    
    public function CheckAnswer($request){
        if($request->folder_id==$this->folder->id){
            $translation=$this->folder->cards()->select('translation')->where('id', $request->card_id)->get();
            if($translation=$request->value){
                return true;
            }
            else{
                return $translation; 
            }
        }
    }
}
