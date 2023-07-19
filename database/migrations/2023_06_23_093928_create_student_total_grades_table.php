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
        DB::statement(
            " 
            CREATE VIEW student_total_grades AS
            SELECT 
            students.id as stuId ,students.name as stuName ,SUM(student_subjects.total) as total_subjects_mark,students.year_id
            from student_subjects
            INNER JOIN students on students.id=student_subjects.student_id
            group by students.id,students.name,students.year_id 
            ;
       "
       );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_total_grades');
    }
};
