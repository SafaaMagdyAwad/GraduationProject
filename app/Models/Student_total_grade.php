<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_total_grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'stuId',
        'stuName',
        'total_subjects_mark',
    ];
}
