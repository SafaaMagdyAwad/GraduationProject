<?php

namespace App\Http\Resources;

use App\Models\Student_total_grade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            'name'=>$this->name,
            'year_id'=>$this->year_id,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'password'=>$this->password,
        ];
    }
}
