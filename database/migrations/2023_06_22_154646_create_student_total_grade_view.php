<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // DB::statement(
        //      " 
        //     //  CREATE VIEW student_total_grade AS
        //     //  SELECT students.name as stuName 
        //     //  ,students.id as stuId ,SUM(student_subjects.total) as total_subjects_mark
        //     //  from student_subjects
        //     //  INNER JOIN students on students.id=student_subjects.student_id
        //     //  group by students.id
        //     //  ;
        // "
        // );
       
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_total_grade_view');
    }
};
