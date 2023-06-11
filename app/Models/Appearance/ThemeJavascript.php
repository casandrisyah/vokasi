<?php

namespace App\Models\Appearance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeJavascript extends Model
{
    use HasFactory;
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
