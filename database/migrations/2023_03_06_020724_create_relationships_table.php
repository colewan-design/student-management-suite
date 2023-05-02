<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('relationship_id')->unique()->nullable();
            $table->string('student_id');
            $table->string('teacher_id');
            $table->string('student_name');
            $table->string('teacher_name');
            $table->string('subject');
            $table->string('level');
            $table->timestamps();
            $table->softDeletes();
        });

        $relationship = \App\Models\relationship::all();
        $count = $relationship->count();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationship');
    }
}
