<?php

namespace App\Models\Profil;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educational_backgrounds';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
