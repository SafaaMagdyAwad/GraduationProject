<?php

namespace App\Http\Controllers;

use App\Models\Student_total_grade;
use Illuminate\Http\Request;

class StudentTotalGradeController extends Controller
{
    public function get_grade($id){

        if ($id) {

            return  Student_total_grade::where('stuId', $id)->get();
        } else {
            return response()->json([
                "msg" => "ادخل رقم جلوس الطالب "
            ], 404);
        }

    }
}
