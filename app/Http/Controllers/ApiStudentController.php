<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\Student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class ApiStudentController extends Controller
{
    public function all()
    {
        $students = Student::all();
        //op sum  contoller s
        //insert
        return StudentResource::collection($students);
    }
    public function search($id)
    {
        $student = Student::find($id);

        if ($student == null) {
            return response()->json([
                "msg" => "هذا الطالب غير موجود بقاعدة البيانات"
            ], 404);
        }
        return new StudentResource($student);
    }
    public function getStudent($id)
    {
        $student = Student::find($id);


    }


    public function search_by_name($name)
    {
        if ($name) {

            return  Student::where('name', $name)->get();
        } else {
            // echo "ادخل اسم الطالب";
            return response()->json([
                "msg" => "ادخل اسم الطالب "
            ], 404);
        }
    }
     public function search_by_id_in_year($year_id,$id)
    {
        if ($id) {

            return  Student::where('id', $id)
            ->where('year_id', $year_id)
            ->get();
        } else {
            // echo "ادخل اسم الطالب";
            return response()->json([
                "msg" => "ادخل اسم الطالب "
            ], 404);
        }
    }
     public function search_by_name_in_year($year_id,$name)
    {
        if ($name) {

            return  Student::where('name', $name)
            ->where('year_id', $year_id)
            ->get();
        } else {
            // echo "ادخل اسم الطالب";
            return response()->json([
                "msg" => "ادخل اسم الطالب "
            ], 404);
        }
    }
    public function search_by_token($token)
    {
        if ($token) {

            return  Student::where('access_token', $token)->get();
        } else {
            // echo "ادخل اسم الطالب";
            return response()->json([
                "msg" => "ادخل اسم الطالب "
            ], 404);
        }
    }
    public function get_students_in_one_year($year_id)
    {
        if ($year_id) {

            return  Student::where('year_id', $year_id)->get();
        }
    }
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:100",
            "email" => "required|unique:students",
            "password" => "required",
            "year_id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "msg" => $validator->errors()
            ], 301);
        }
        $request->password = bcrypt($request->password);
        //create
        Student::create(
            [
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password,
                "year_id" => $request->year_id,
                "phone" => $request->phone,

            ]
        );
        //msg
        return response()->json([
            "msg" => "تم اضافه الطالب بنجاح"
        ], 201);
    }

    public function update(Request $request, $id)
    {
        //vallidation
        $validator = Validator::make($request->all(), [
            "name" => 'string|max:100',
            "email" => 'email',
            "password" => 'string',



        ]);
        if ($validator->fails()) {
            return response()->json([
                "msg" => $validator->errors()
            ], 301);
        }

        $student = Student::find($id);
        if ($student == null) {
            return response()->json([
                "msg" => "هذا الطالب غير موجود بقاعدة البيانات"
            ], 404);
        }


        $request->password = bcrypt($request->password);

        if($request->name){
            $student->update([
                "name" => $request->name,
            ]);
        }
        if($request->email){
            $student->update([
                "email" => $request->email,
            ]);
        }
        if($request->password){
            $student->update([
                "password" => $request->password,
            ]);
        }
        if($request->year_id){
            $student->update([
                "year_id" => $request->year_id,
            ]);
        }
        if($request->phone){
            $student->update([
                "phone" => $request->phone,
            ]);
        }

        return response()->json([
            "msg" => "تم التعديل بنجاح"
        ], 201);
    }
    public function delete($id)
    {
        // find
        $student = Student::find($id);
        if ($student == null) {
            return response()->json([
                "msg" => "هذا الطالب غير موجود بقاعدة البيانات"
            ], 404);
        }
        //delete
        $student->delete();
        //msg
        return response()->json([
            "msg" => "تم حذف الطالب من قاعده البيانات بنجاح"
        ], 201);
    }


}
