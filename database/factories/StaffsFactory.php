<?php

namespace Database\Factories;

use App\Models\Staffs;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffsFactory extends Factory
{
    protected $model = Staffs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected static $counter = 0;

    public function definition()
    {
        $levels = range(1, 12);
        $shifts = ['Morning', 'Evening'];
        $contracts = ['Permanent', 'Contractual'];
        $roles = ['School Admin', 'Guard', 'Staff', 'Finance Officer'];
    
        static::$counter++;
    
        $current_month = date('m');
        $current_day = date('d');
        $current_year = date('y');
    
        $account_id = 'STF' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
    
        return [
            'account_id' => $account_id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'contract_type' => $this->faker->randomElement($contracts),
            'role' => $this->faker->randomElement($roles),
            'shift' => $this->faker->randomElement($shifts),
            'location' => $this->faker->address(),
            'joining_date' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
        ];
    }
    
}
