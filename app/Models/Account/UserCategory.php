<?php

namespace App\Models\Account;

use App\Models\Civitas\User;
use App\Models\Setting\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;
    protected $table = 'user_categories';

    public function user()
    {
        return $this->hasMany(User::class, 'user_category_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role');
    }
}
