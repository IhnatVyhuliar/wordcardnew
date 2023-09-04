<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder_follower extends Model
{
    use HasFactory;

    protected $fillable=['id','user_id','folder_id' ];
    
}
