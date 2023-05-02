<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('exam_id')->unique()->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('link');
            $table->timestamps();
            $table->softDeletes();
        });

        $exams = \App\Models\exams::all();
        $count = $exams->count();

        foreach ($exams as $exams) {
            $exams->account_id = $this->generateAccountId($count++);
            $exams->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
       
    }
   
}
