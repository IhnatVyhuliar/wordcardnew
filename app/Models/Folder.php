<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Card;
class Folder extends Model
{
    use HasFactory;

    protected $fillable=['id', 'name','code','user_id', 'favorite', 'status'];
    
    public function cards()
    {
        return $this->hasMany(Card::class, 'folder_id');
    }
}
