<?php

namespace Database\Factories;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomsFactory extends Factory
{
    protected $model = Rooms::class;

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
    
        $room_id = 'R' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
        $building_id = 'B' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
    
        return [
            'room_id' => $room_id,
            'room_name' => $this->faker->word(),
            'building_id' => $building_id,
            'room_number' => $this->faker->numberBetween(1, 10),
            'maximum_capacity' => $this->faker->numberBetween(20, 50),
        ];
    }
}
