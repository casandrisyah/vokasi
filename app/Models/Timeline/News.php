<?php

namespace App\Models\Timeline;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    public function getImageAttribute()
    {
        if($this->thumbnail){
            return asset('storage/' . $this->thumbnail);
        }else{
            return asset('image.png');
        }
    }
}
