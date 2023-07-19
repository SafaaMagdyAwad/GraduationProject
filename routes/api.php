<?php
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiStudenSubjectsController;
use App\Http\Controllers\ApiStudentController;
use App\Http\Controllers\StudentDegreeController;
use App\Http\Controllers\ApiMessageController;
use App\Http\Controllers\StudentTotalGradeController;
use App\Http\Resources\StudentCourcesResource;
use App\Http\Resources\StudentDegreeResource;
use App\Http\Resources\StudentTotalGradeResource;
use App\Models\Student_cource;
use App\Models\Student_degree;
use App\Models\Student_total_grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('students',[ApiStudentController::class,'all']);//all students
Route::get('students/search/{id}',[ApiStudentController::class,'search']);//show student
Route::get('students/getStudent/{id}',[ApiStudentController::class,'getStudent']);//show student

Route::get('students/search_by_name/{name}',[ApiStudentController::class,'search_by_name']);//show student
Route::get('students/search_by_name_in_year/{year}/{name}',[ApiStudentController::class,'search_by_name_in_year']);//show student in one year by student name
// Route::get('students/search_by_name_in_year/{year}/{id}',[ApiStudentController::class,'search_by_id_in_year']);//show student in one year by student id
Route::get('students/search_by_token/{token}',[ApiStudentController::class,'search_by_token']);//show student

Route::get('students/get_students_in_one_year/{year_id}',[ApiStudentController::class,'get_students_in_one_year']);//show student
Route::post('students/store',[ApiStudentController::class,'store']);//insert a student
Route::put('students/update/{id}',[ApiStudentController::class,'update']);//update(change) student data
Route::delete('students/delete/{id}',[ApiStudentController::class,'delete']);//delete student
Route::post('register_admin',[ApiAuthController::class,'register_admin']);//admin rigester
Route::post('login_admin',[ApiAuthController::class,'login_admin']);//admin login
Route::post('logout_admin',[ApiAuthController::class,'logout_admin']);//admin logout
Route::post('login_student',[ApiAuthController::class,'login_student']);//student login
Route::post('logout_student',[ApiAuthController::class,'logout_student']);//student logout
Route::post('insert_marks',[ApiStudenSubjectsController::class,'store']);//insert students marks
Route::put('update_student_marks/{id}/{sid}',[ApiStudenSubjectsController::class,'update']);//change student marks
Route::post('send_messages/{sender_id}/{recever_id}',[ApiMessageController::class,'send']);//change student marks
Route::get('reseve_messages/{sender_id}/{recever_id}',[ApiMessageController::class,'reseve']);//change student marks

//views
Route::get('students_marks/show_in_one_year/{year_id}',function(string $year_id){
    return StudentDegreeResource::collection(Student_degree::where('yearId',$year_id)->get());
});//represents all students marks in all subjects
Route::get('students_marks/show_student_in_one_year/{year_id}/{student_name}',function(string $year_id,string $student_name){
    return StudentDegreeResource::collection(Student_degree::where('yearId',$year_id)
    ->where('stuName',$student_name)
    ->get());
});//represents student in one year marks in all subjects

// Route::get('students_marks/show_student_by_id_in_one_year/{year_id}/{student_id}',function(string $year_id,string $student_id){
//     return StudentDegreeResource::collection(Student_degree::where('id',$student_id)->where('yearId',$year_id) ->get());
// });//represents student in one year marks in all subjects

Route::get('show_students_grade_in_one_year/{year_id}',function(string $year_id){
    return StudentTotalGradeResource::collection(Student_total_grade::where('year_id',$year_id)->get());
});//represents all students degrees
Route::get('student_marks/show/{id}',[StudentDegreeController::class,'get_Student_Subjects_details']);//show one student marks and subjects
Route::get('student_cources/show/{id}',function(string $id){
    return StudentCourcesResource::collection(Student_cource::where('id',$id)->get());
});//show one student marks and subjects
Route::get('students/get_grade/{id}',[StudentTotalGradeController::class,'get_grade']);//get a student total mark in all subjects
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
