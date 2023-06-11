<?php

namespace App\Models\Profil;

use App\Models\Civitas\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    use HasFactory;
    protected $table = 'fundings';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
