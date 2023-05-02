<?php

namespace Database\Factories;

use App\Models\Announcements;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementsFactory extends Factory
{
    protected $model = Announcements::class;

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
    
        $announcement_id = 'A' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
        $superadmin_id = 'SA' . $current_month . $current_day . $current_year . str_pad(static::$counter, 2, '0', STR_PAD_LEFT);
    
        return [
            'announcement_id' => $announcement_id,
            'title' => $this->faker->word(),
            'body' => implode("\n", $this->faker->paragraphs(5)),
            'author_id' => $superadmin_id,
        ];
    }
}
