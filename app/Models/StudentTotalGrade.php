<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTotalGrade extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
            'student_name',
            'total_subjects_marks',
    ];
}
