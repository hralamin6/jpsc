<?php

namespace Database\Factories;

use App\Models\Sell;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sell::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kg = rand(100, 1000);
        $unit_price = rand(80, 120);
        $total_price = $unit_price*$kg;
        return [
            'product_id' => rand(1, 10),
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 10),
            'quantity' => rand(100, 1000),
            'kg' => $kg,
            'unit_price' => $unit_price,
            'total_price' => $total_price,
            'paid_price' => 0,
            'due_price' => $total_price,
        ];
    }
}
