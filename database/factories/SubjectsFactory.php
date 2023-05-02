<?php

namespace Database\Factories;

use App\Models\Subjects;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectsFactory extends Factory
{
    protected $model = Subjects::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected static $counter = 0;

    public function definition()
    {
        $subjects = ['Math', 'Filipino', 'English', 'MAPEH', 'History'];
    
        static::$counter++;
    
        $current_month = date('m');
        $current_day = date('d');
        $current_year = date('y');
    
        $subject_id = 'SBJ' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
    
        return [
            'subject_id' => $subject_id,
            'grade' => $this->faker->numberBetween(1, 12),
            'subject_name' => $this->faker->randomElement($subjects),

        ];
    }
    
}
