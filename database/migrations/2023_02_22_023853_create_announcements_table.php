<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('announcement_id')->unique()->nullable();
            $table->string('title');
            $table->longText('body');
            $table->string('author_id');
            $table->timestamps();
            $table->softDeletes();
        });

        $announcements = \App\Models\Announcements::all();
        $count = $announcements->count();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
