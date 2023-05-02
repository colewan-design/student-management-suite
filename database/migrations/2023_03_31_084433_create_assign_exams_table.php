<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id');
            $table->string('exam_id');
            $table->date('date_assigned')->nullable();
            $table->date('date_due')->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
    

        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_exams');
    }
}
