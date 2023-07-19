<?php

namespace App\Http\Resources;

use App\Http\Controllers\StudentTotalGradeController;
use App\Models\StudentTotalGrade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentTotalGradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'student_id'=>$this->stuId,
            'student_name'=>$this->stuName,
            'total_subjects_marks'=>$this->total_subjects_mark,
        ];
    }
}
