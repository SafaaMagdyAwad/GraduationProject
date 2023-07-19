<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentDegreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stuName' => $this->stuName,
            'subiect_details' =>
                [
                    'subject_id'=>$this->subId,
                    'subName' => $this->subName,
                    'mid' => $this->mid,
                    'final' => $this->final,
                    'total' => $this->total,                        
                ],
            'yearName' => $this->yearName,
        ];
    }
}
