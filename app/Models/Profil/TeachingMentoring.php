<?php

namespace App\Models\Profil;

use App\Models\Civitas\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingMentoring extends Model
{
    use HasFactory;
    protected $table = 'teaching_mentorings';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
