<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('quiz_id')->unique()->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('link');
            $table->timestamps();
            $table->softDeletes();
        });

        $quizzes = \App\Models\Quizzes::all();
        $count = $quizzes->count();

        foreach ($quizzes as $quizzes) {
            $quizzes->account_id = $this->generateAccountId($count++);
            $quizzes->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
       
    }
   
}
