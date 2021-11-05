<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testproducts(){
        //Given we have vendors in the database
        $product  = \App\Models\Product::factory(Product::class)->create();

        //When user visit the vendors page
        $response = $this->get('/products');
        $response->assertSee($product->product_name);
    }
}
