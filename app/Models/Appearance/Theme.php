<?php

namespace App\Models\Appearance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    public function stylesheet()
    {
        return $this->hasMany(ThemeStylesheet::class);
    }
    public function javascript()
    {
        return $this->hasMany(ThemeJavascript::class);
    }
    public function layout()
    {
        return $this->hasMany(Layout::class);
    }
    public function getImageAttribute()
    {
        if($this->thumbnail){
            return "<div class='symbol-label'><img src='".asset('storage/' . $this->thumbnail)."' alt='".$this->name."' class='w-100' /></div>";
        }else{
            return "<div class='symbol-label'><img src='".asset('image.png')."' alt='".$this->name."' class='w-100' /></div>";
            // $name = Str::substr($this->name, 0, 1);
            // return "<div class='symbol-label fs-3 bg-light-danger text-danger'>".$name."</div>" . $simbol;
        }
    }
}
