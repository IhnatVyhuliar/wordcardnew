<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Folder;
class Card extends Model
{
    use HasFactory;
    
    protected $fillable=['word','translation','definition','user_id','folder_id','image'];

    public function folder()
    {
        
        return $this->belongsTo(Folder::class);
    }
}
