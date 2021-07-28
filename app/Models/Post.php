<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','body','slug'];
    public function catogery(){
        return $this->belongsTo('App\Models\catogery');
    }
}
