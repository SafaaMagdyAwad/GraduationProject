<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentSupjectsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "student_name"=>$request->student_name,
            "yearname"=>$request->year_name,
            "subjectname"=>$request->subject_name,
            "middeg"=>$request->mid_deg,
            "finaldeg"=>$request->final_deg,
            "total"=>$request->total,
        ];
    }
}
