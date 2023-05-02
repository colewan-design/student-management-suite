<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subjects::factory(10)->create();
        \App\Models\Students::factory(10)->create();
        \App\Models\Teacher::factory(10)->create();
        \App\Models\Staffs::factory(10)->create();
        \App\Models\Buildings::factory(10)->create();
        \App\Models\Rooms::factory(10)->create();
        \App\Models\Announcements::factory(10)->create();
        $this->call([

            //-------wag gagalawin--------------------//
            UserSeeder::class,
           // AssignExamSeeder::class,
            //AssignQuizSeeder::class,
            //-----------------------------------------//
       ]);
    }
}
