<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCourcesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'student_id'=>$this->id,
            'student_name'=>$this->stuName,
            'subject_name'=>$this->subName,
            'subject_description'=>$this->subDisc,
            'year_name'=>$this->yearName,
            'stubject_id'=>$this->subId,
        ];
    }
}
