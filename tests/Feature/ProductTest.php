<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function product_has_name(){

        // create new product
        $product = New Product('Fallout 4');

        // assert to see if product name is equal to chosen name
        $this->assertEquals('Fallout 4', $product->name());
    }
}
