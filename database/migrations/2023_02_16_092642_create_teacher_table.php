<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_id')->unique()->nullable();
            $table->string('position');
            $table->string('major_subject');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('room_name')->nullable();
            $table->string('contact_number');
            $table->string('email')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        $teachers = \App\Models\Teacher::all();
        $count = $teachers->count();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
