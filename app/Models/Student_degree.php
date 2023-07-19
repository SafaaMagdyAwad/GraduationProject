<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_degree extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'stuName',
        'yearId',
        'subName',
        'yearName',
        'mid',
        'final',
        'total',
    ];
}
