<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;
    protected $table = 'program_studis';

    public function category_prodi()
    {
        return $this->belongsTo(CategoryProdi::class, 'category_prodi_id', 'id');
    }
}
