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
            $url = url('/verify/' . $randomString);
            // You can use this $url in your email or wherever you need it.
            return $url;
        }
    }   

    public function verify($hash){
    
        if(isset($this->user_id)&&isset($this->hash)){
            
            if($hash==$this->hash){
                //dd($hash);
                if ($this->user->hasVerifiedEmail()) {
                    return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
                }
        
                if ($this->user->markEmailAsVerified()) {
                    event(new Verified($request->user()));
                }
            }
            
        }
        else{
            return to_route('main');
        }
    }
}