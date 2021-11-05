<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            return [
                'product_name' => 'AMAN GAS',
                'refill_new' => 'New Gas',
                'product_brand' => 'AMAN GAS',
                'vendor_id' => 111,
                'product_size' => '13KGS',
                'product_type' => 'CYLINDER',
                'selling_price' => '3500KES',
                'unit_price' => '2000KES',
                'reorder_level' => '3',
                'image' => 'https://xoom-prod.s3.eu-west-2.amazonaws.com/AMAN%20GAS/AMAN6.jpg',
          ];
    }
}
