<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vendor;
class VendorsTest extends TestCase
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
    public function testgetVendors(){
        //Given we have vendors in the database
        $vendor  = \App\Models\Vendor::factory(Vendor::class)->create();

        //When user visit the vendors page
        $response = $this->get('/vendors');
        $response->assertSee($vendor->vendor_name);
    }
    public function test_store_vendor_details(){
        $response = $this->get('/vendors', $this->data());
        $this->assertCount(54, Vendor::all());
    }
    private function data(){
    return [
        'vendorname' => 'ALFA GAS', 
        'vendor_address' =>'NAIROBI CBD',
        'phone' => +254703894372,
        'person' => 'DANIEL KIMANI',
        'email' => 'kimdan2030@gmail.com',
        'doc' => 'contract',
        'image' => 'photo',
    ];
    }
}
