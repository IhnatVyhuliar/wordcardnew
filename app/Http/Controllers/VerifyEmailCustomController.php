<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
class VerifyEmailCustomController extends Controller
{
    private $user;
    public function __invoke($user){

        $this->user=$user;
        app('verify_email')->setId($this->user);
    }

    public function getHash(){
        
        /*$randomString = Str::random(40);

        //$request= new Request;
        $baseUrl='http://127.0.0.1:8000/';
        $url=$baseUrl.'/verify'.$randomString;*/
        $url=app('verify_email')->create_hash();
        //dd($url);
        return $url;
    }

    public function checkHash(Request $request){
        dd($request->hash);
        $url=app('verify_email')->verify($request->hash);
        //dd($url);
        return $url;
    }
}
