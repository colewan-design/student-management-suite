<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('class_id')->unique()->nullable();
            $table->string('class_name')->unique()->nullable();
            $table->string('subject_id')->nullable();
            $table->string('room_id')->nullable();
            $table->string('teacher_id')->nullable();
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
        Schema::dropIfExists('classes');
    }
}
