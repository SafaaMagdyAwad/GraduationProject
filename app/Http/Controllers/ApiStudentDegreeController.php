<?php
namespace App\Http\Controllers;
use App\Http\Resources\StudentDegreeResource;
use App\Models\StudentDegree;
class ApiStudentDegreeController extends Controller
{
    public function show($id){
        $student_details=StudentDegree::find($id);
        if($student_details==null){
            return response()->json([
            "msg"=>"لم يتم ادراج درجات لهذا الطالب حتى الان"
            ],404);
        }
    return response()->json(StudentDegreeResource::collection($student_details));
   }
}
