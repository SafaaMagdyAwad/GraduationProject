<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_cource extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'stuName',
        'subName',
        'subId',
        'yearName',
    ];
}
