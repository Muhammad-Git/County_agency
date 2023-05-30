<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class goal extends Model
{
    use HasFactory;
    protected $table = 'goal';
    protected $fillable = [
        'user_id','start_date','end_date','goal','created_at','updated_at', 'subscription','achived'
    ];
    
}