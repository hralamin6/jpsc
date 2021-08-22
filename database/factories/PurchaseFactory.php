<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

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
        $paid_price = $total_price*80/100;
        $due_price = $total_price-$paid_price;
        return [
            'product_id' => rand(1, 10),
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 10),
            'quantity' => rand(100, 1000),
            'kg' => $kg,
            'unit_price' => $unit_price,
            'total_price' => $total_price,
            'paid_price' => $paid_price,
            'due_price' => $due_price,
        ];
    }
}
