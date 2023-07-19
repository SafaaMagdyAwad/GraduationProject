<?php

namespace App\Http\Controllers;

use App\Models\Student_degree;
use Illuminate\Http\Request;

class StudentDegreeController extends Controller
{
    public function get_Student_Subjects_details($id){

        if ($id) {

            return  Student_degree::where('id', $id)->get();
        } else {
            return response()->json([
                "msg" => "ادخل اسم الطالب "
            ], 404);
        }

    }
}
