<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Cache;

class CacheHelper{
    public static function storeCache(string $variable_name, $value){

        Cache::add($variable_name, $value);
    }

    public static function getVariable(string $variable_name){
        if(Cache::get($variable_name)|| Cache::get($variable_name)==0){
            return Cache::get($variable_name);
        }
        else{
            return null;
        }
    }

    public static function Forget(string $variable_name){
        Cache::forget($variable_name);
    }

    public static function Close(){
        Cache::flush();
    }
}