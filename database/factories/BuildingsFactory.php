<?php

namespace Database\Factories;

use App\Models\Buildings;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingsFactory extends Factory
{
    protected $model = Buildings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected static $counter = 0;

    public function definition()
    {
        static::$counter++;
    
        $current_month = date('m');
        $current_day = date('d');
        $current_year = date('y');
    
        $building_id = 'B' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
    
        return [
            'building_id' => $building_id,
            'building_name' => $this->faker->unique()->word(),
          
        ];
    }
}
