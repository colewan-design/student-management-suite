<?php

namespace Database\Factories;

use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentsFactory extends Factory
{
    protected $model = Students::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected static $counter = 0;

    public function definition()
    {
        $levels = range(1, 12);
        $sections = ['A', 'B'];
        $dropouts = ['Yes', 'No'];
        $genders = ['Male', 'Female'];
    
        static::$counter++;
    
        $current_month = date('m');
        $current_day = date('d');
        $current_year = date('y');
    
        $account_id = 'ST' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
    
        return [
            'account_id' => $account_id,
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'student_birthdate' => $this->faker->date('Y-m-d', '-18 years'),
            'email' => $this->faker->unique()->safeEmail(),
            'contact_number' => $this->faker->phoneNumber(),
            'level' => $this->faker->randomElement($levels),
            'section' => $this->faker->randomElement($sections),
            'address' => $this->faker->address(),
            'age' => $this->faker->numberBetween(18, 24),
            'dropout' => $this->faker->randomElement($dropouts),
            'gender' => $this->faker->randomElement($genders),
        ];
    }
    
}
