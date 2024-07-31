<?php

namespace App\Services;


use App\Models\Folder;

use Illuminate\Support\Arr;
use  App\Http\Controllers\Card\CardController;

class FolderLearnService
{
    /**
     * Register services.
     */
    private $folder_id;
    private $folder;
    private $user_id;
    private $cards_num;

    public function setFolder(int $folder_id, $user_id = NULL){

        if(Folder::where($this->folder_id)->exists()){
        
            $this->folder_id = $folder_id;

            $this->user_id=$user_id;
            
            $this->folder=Folder::find($this->folder_id);

        }
        
    }

    public function getFolderId(){
        return $this->folder->id;
    }

    public function getAccess(){
        $access=false;

        if($this->folder!=NULL){
            if($this->user_id){
                $owner=$this->folder->user_id==$this->user_id;
    
                if($owner){
                    $access=true;
                }
                
            }

            if($this->folder->status==1){
                $access=true;
            }
            
        }
        return $access;
        
    }

    

    

    public function getCardsNum(){
        $this->cards_num=$this->folder->cards()->where('folder_id', $this->folder->id)->count();
        return $this->cards_num;
    }

    public function getCards(int $cur_card_num, int $cards_amount){

        if($cards_amount<=$this->getCardsNum()&& $cur_card_num<=$cur_card_num){
            $card=$this->folder->cards()->where('folder_id', $this->folder->id)->get();

            $cur_card=$card[$cur_card_num];
            //dd($cur_card);
            $cur_card_id=$cur_card['id'];

            $cards['main']=$cur_card;
            $cards_values=$this->getCardOptions($cur_card_id, $cards_amount);
            $main_option=$cur_card->toArray();
            array_push($cards_values, $main_option);
            $cards_values=Arr::shuffle($cards_values);
            $cards['values']=$cards_values;
           //dd($cards);
            return $cards;
        }
    }

    public function getShuffledCards(int $cur_card_num, int $cards_amount){

        if($cards_amount<=$this->getCardsNum()&& $cur_card_num<=$cur_card_num){
            $cards_arr = $this->folder->cards()->where('folder_id', $this->folder->id)->get();
            $card = $cards_arr;

            $cur_card=$card[$cur_card_num];
            //dd($cur_card);
            $cur_card_id=$cur_card['id'];

            $cards['main']=$cur_card;
            $cards_values=$this->getCardOptions($cur_card_id, $cards_amount);
            $main_option=$cur_card->toArray();
            array_push($cards_values, $main_option);
            $cards_values=Arr::shuffle($cards_values);
            $cards['values']=$cards_values;
           //dd($cards);
            return $cards;
        }
        

    }
    public function getCardOptions(int $cur_card_id,int $cards_options_amount): array{
        $translation_options=$this->to_array($this->folder->cards()->select('translation')->where('folder_id', $this->folder->id)->where('id', '!=', $cur_card_id)->get());
        
        $arr_options=[];

        if($cards_options_amount<=4){
            $arr_options=Arr::random($translation_options,1);
            
        }
        else if($cards_options_amount>4){
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
    
    public function CheckAnswer(int $main_card_id, $value, int $folder_id){
        if($folder_id==$this->folder->id){
            $main_card=$this->folder->cards()->find($main_card_id);
            $value_main=$main_card['translation'];
            if ($value_main==$value && $this->is_owner()){
               
                CardController::increaseProcent($main_card);
            }
            return ['success'=>$value_main==$value, 'correct'=>$value_main, 'input_value'=>$value];

        }
    }
    
    protected function is_owner(){

        return $this->folder->user_id==$this->user_id && $this->folder->user_id!=NULL;
     }
}
