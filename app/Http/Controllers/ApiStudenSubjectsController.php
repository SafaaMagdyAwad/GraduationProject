<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentSupjectsResource;
use App\Models\Student;
use App\Models\Student_subject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

 class ApiStudenSubjectsController extends Controller
{

    public function store(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            "student_id" => "required",
            "subject_id" => "required",
            "mid" => "max:5",//dd.dd
            "final" => "max:6",
            "user_id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "msg" => $validator->errors()
            ], 301);
        }

       $safaa=Student_subject::where("student_id", $request->student_id)
            ->where("subject_id", $request->subject_id)
            ->exists();
        if(!$safaa) {
            $student_detail=Student::where("id",$request->student_id)->first();
            $subject_detail=Subject::where("id",$request->subject_id)->first();
            if($student_detail->year_id==$subject_detail->year_id){
                if($request->final&&$request->mid){
                   if(($request->final)>100||($request->mid)>50){
                       return response()->json([
                       "msg" => "final cant be >100 &  mid can't be >50"
                   ], 404);
                    }else{
                        Student_subject::create([
                            "student_id" => $request->student_id,
                "subject_id" => $request->subject_id,
                "user_id" => $request->user_id,
                            "mid" => $request->mid,
                            "final"=>$request->final,
                            "total"=> $request->mid+$request->final,
                        ]);
                    }

               }else if($request->mid){
                    if(($request->mid)>50){
                       return response()->json([
                       "msg" => "mid can't be >50"
                   ], 404);
                    }else{
                    Student_subject::create([
                        "student_id" => $request->student_id,
                        "subject_id" => $request->subject_id,
                        "user_id" => $request->user_id,
                        "mid" => $request->mid,
                        "final"=>0,
                        "total"=>$request->mid,
               ]);
                    }

               }else if($request->final){
                   if(($request->final)>100){
                       return response()->json([
                       "msg" => "final can't be >100"
                   ], 404);
                    }else{
                        Student_subject::create([
                            "student_id" => $request->student_id,
                            "subject_id" => $request->subject_id,
                            "user_id" => $request->user_id,
                            "mid"=>0,
                            "final" => $request->final,
                            "total"=>$request->final,
                        ]);
                    }

               }

            }else{
            return response()->json([
                "msg" => "لا يسمح لهذا الطالب بالتسجيل في هذه الماده "
            ], 301);
         }

        //msg
        return response()->json([
            "msg" => "تم تسجيل درجات الطالب بنجاح"
        ], 201);
        } else{
            return response()->json([
            "msg" => " يوجد بالفعل درجات مخزنه في هذه الماده لهذا الطالب توجه لصفحه تعديل الدرجات"
        ], 201);
        }



    }

        //for inserting students marks and calculatind the degree

    public function update(Request $request, $stuid, $subid)
    {
        $validator = Validator::make($request->all(), [
            "mid" => "max:4",
            "final" => "max:5",

        ]);
        $stu_sub = Student_subject::where("student_id", $stuid)
            ->where("subject_id", $subid)
            ->first();
        $id = $stu_sub->id;
        //vallidation
        if ($validator->fails()) {
            return response()->json([
                "msg" => $validator->errors()
            ], 301);
        }
        $degrees = Student_subject::find($id); //studen subjects id

        if ($degrees == null) {
            return response()->json([
                "msg" => "هذا الطالب غير موجود بقاعدة البيانات"
            ], 404);
        }
         if($request->mid&!$request->final){
             if(($request->mid)>50){
                return response()->json([
                "msg" => "mid can't be >50"
            ], 404);
             }else{
                  $degrees->update([
            "mid" => $request->mid,
            "total"=>$request->mid+$degrees->final,
        ]);
             }

        }
        if($request->final&!$request->mid){
            if(($request->final)>100){
                return response()->json([
                "msg" => "final can't be >100"
            ], 404);
             }else{
                  $degrees->update([
            "final" => $request->final,
            "total" => $request->final+$degrees->mid,
        ]);
             }

        }
        if($request->final&&$request->mid){
            if(($request->final)>100||($request->mid)>50){
                return response()->json([
                "msg" => "final cant be >100 &  mid can't be >50"
            ], 404);
             }else{
                  $degrees->update([
            "final" => $request->final,
            "mid"=> $request->mid,
            "total"=> $request->final+ $request->mid,
        ]);
             }

        }

        return response()->json([
            "msg" => "تم تعديل درجات الطالب بنجاح"
        ], 201);
    }
}
