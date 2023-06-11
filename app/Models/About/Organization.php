<?php

namespace App\Models\About;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
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
