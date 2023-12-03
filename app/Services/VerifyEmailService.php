<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class VerifyEmailService
{
    
    protected $user_id;
    protected $hash=null;
    public function setId($user){
        $this->user=$user;
    }

    public function create_hash(){
        if(!isset($this->user)){
            $randomString = Str::random(40);
            //$request= new Request;
            $baseUrl=__DIR__;
            $url=$baseUrl.'/verify'.$randomString;
            //dd($url);
            return $url;
        }
    }   

    public function verify($hash){
        dd('he');
        if(isset($this->user_id)&&isset($this->hash)){
            
            if($hash==$this->hash){
                if ($this->user->hasVerifiedEmail()) {
                    return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
                }
        
                if ($this->user->markEmailAsVerified()) {
                    event(new Verified($request->user()));
                }
            }
        }
    }
}