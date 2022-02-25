<?php

namespace Tests\Unit;
use App\Http\Controllers\Product;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    protected $product;


    public function setUp() :void
    {
         $this->product = new Product('Fallout 4',140);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_product_has_a_name()
    {

        $this->assertEquals('Fallout 4', $this->product->name());
    }

    /**
     * Price test
     * @test
     */

    public function product_has_a_price(){

        //1 create product

        //2 give product a name and price
        $this->assertEquals(140,$this->product->price());


    }
}
