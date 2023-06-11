<?php

namespace App\Models\Profil;

use App\Models\Civitas\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTeaching extends Model
{
    use HasFactory;
    protected $table = 'staff_teachings';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
