<?php

namespace App\Models;

use App\Models\Profil\StaffTeaching;
use App\Models\Profil\TeachingMentoring;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';

    public function staff_teachings()
    {
        return $this->hasMany(StaffTeaching::class, 'subject_id');
    }

    public function teaching_mentorings()
    {
        return $this->hasMany(TeachingMentoring::class, 'subject_id');
    }
}
