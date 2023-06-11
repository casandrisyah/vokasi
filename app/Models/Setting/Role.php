<?php

namespace App\Models\Setting;

use App\Models\Civitas\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany(User::class, 'role');
    }

    public function user_category()
    {
        return $this->hasMany(UserCategory::class, 'role');
    }
}
