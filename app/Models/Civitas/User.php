<?php

namespace App\Models\Civitas;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Account\UserCategory;
use App\Models\Profil\Education;
use App\Models\Profil\Funding;
use App\Models\Profil\Research;
use App\Models\Profil\StaffTeaching;
use App\Models\Profil\TeachingMentoring;
use App\Models\Setting\Role;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role_name()
    {
        return $this->belongsTo(Role::class, 'role');
    }

    public function user_category()
    {
        return $this->belongsTo(UserCategory::class, 'user_category_id');
    }

    public function education()
    {
        return $this->hasMany(Education::class, 'user_id');
    }

    public function pendanaan() {
        return $this->hasMany(Funding::class, 'user_id');
    }

    public function research()
    {
        return $this->hasMany(Research::class, 'user_id');
    }

    public function teaching_mentoring()
    {
        return $this->hasMany(TeachingMentoring::class, 'user_id');
    }

    public function staff_teaching()
    {
        return $this->hasMany(StaffTeaching::class, 'user_id');
    }

    public function deleteDosen()
    {
        if ($this->avatar != null) {
            Storage::delete($this->avatar);
        }
        $this->education()->delete();
        $this->pendanaan()->delete();
        $this->research()->delete();
        $this->teaching_mentoring()->delete();
        $this->delete();
    }

    public function deleteStaff()
    {
        if ($this->avatar != null) {
            Storage::delete($this->avatar);
        }
        $this->education()->delete();
        $this->staff_teaching()->delete();
        $this->delete();
    }
}
