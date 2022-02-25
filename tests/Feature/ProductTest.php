<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    /**
     * Setup methods run before every method in your test class
     *
     */

    protected $product;

    public function setUp(): void
    {
       $this->product = new Product('Fallout 4',150);
    }
    /**
     *check if product has name
     * @return void
     */
    /** @test */
    public function product_has_name(){



        // assert to see if product name is equal to chosen name
        $this->assertEquals('Fallout 4', $this->product->name());
    }

    /**
     * @test
     * Check if product has price
     */
    public function product_has_price(){


        $this->assertEquals(150,$this->product->price());

    }
}
