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
            CREATE VIEW student_cources AS
             SELECT  students.id as id, students.name as stuName,subjects.id as subId ,subjects.name as subName,subjects.subject_discription as subDisc ,years.name as yearName 
            from students
            INNER JOIN subjects on students.year_id=subjects.year_id
            INNER JOIN years ON  years.id=students.year_id
            ;
            "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_cources_view');
    }
};
