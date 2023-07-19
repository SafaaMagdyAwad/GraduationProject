<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDegree extends Model
{
    use HasFactory;
    protected $fillable = [
        'stuName',
        'subName',
        'mid',
        'final',
        'total',
        'yearName',
        'id',
        
    ];
}
