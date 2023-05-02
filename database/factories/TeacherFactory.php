<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected static $counter = 0;

    public function definition()
    { 
        $subjects = ['Math', 'Filipino', 'English', 'MAPEH', 'History'];
        $rooms = ['Discussion Room A', 'Laboratory Room A', 'Discussion Room B', 'Laboratory Room B'];
        $positions = [
            'Teacher I',
            'Teacher II',
            'Teacher III',
            'Special Education Teacher I',
            'Special Education Teacher II',
            'Special Education Teacher III',
            'Special Education Teacher IV',
            'Special Science Teacher I',
            'Special Science Teacher II',
            'Special Science Teacher III',
            'Special Science Teacher IV',
            'Special Science Teacher V',
            'Head Teacher I',
            'Head Teacher II',
            'Head Teacher III',
            'Head Teacher IV',
            'Head Teacher V',
            'Head Teacher VI',
            'Master Teacher I',
            'Master Teacher II'
        ];
        static::$counter++;
    
        $current_month = date('m');
        $current_day = date('d');
        $current_year = date('y');
    
        $account_id = 'T' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
    
        return [
            'account_id' => $account_id,
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'contact_number' => $this->faker->phoneNumber(),
            'position' => $this->faker->randomElement($positions),
            'room_name' => $this->faker->randomElement($subjects),
            'major_subject' => $this->faker->randomElement($subjects),
        ];
    }
    
}
