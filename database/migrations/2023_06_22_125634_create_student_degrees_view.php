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
            CREATE VIEW student_degrees AS
             SELECT   students.name as stuName ,student_subjects.mid,student_subjects.final,student_subjects.total,subjects.name as subName ,years.name as yearName,years.id as yearId ,students.id as id,student_subjects.subject_id as subId
            from student_subjects
            INNER JOIN students on students.id=student_subjects.student_id
            INNER JOIN subjects ON  subjects.id=student_subjects.subject_id
            INNER JOIN years ON  years.id=students.year_id
            ORDER BY years.id
            ;
            "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_degrees_view');
    }
};
