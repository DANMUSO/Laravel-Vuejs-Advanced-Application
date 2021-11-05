<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VendorFactory extends Factory
{
    
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_name' => 'AMAN GAS',
            'vendor_address' => 'JAMIA MALL',
            'phone' => '0703894372',
            'email' => 'info@xoomgas.com',
            'person' => 'Daniel Kimani',
            'doc' => 'https://xoom-prod.s3.eu-west-2.amazonaws.com/AMAN%20GAS/AMAN6.jpg',
            'image' => 'https://xoom-prod.s3.eu-west-2.amazonaws.com/AMAN%20GAS/AMAN6.jpg',
        ];
    }
}
