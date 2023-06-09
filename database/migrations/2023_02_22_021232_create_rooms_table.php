<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('room_id')->unique()->nullable();
            $table->string('room_name');
            $table->string('building_id');
            $table->string('room_number');
            $table->string('maximum_capacity');
            $table->timestamps();
            $table->softDeletes();
        });

        $subjects = \App\Models\Subjects::all();
        $count = $subjects->count();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
