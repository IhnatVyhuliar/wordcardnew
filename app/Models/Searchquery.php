<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Searchquery extends Model
{
    use HasFactory;

    protected $fillable=['query','number'];
}
