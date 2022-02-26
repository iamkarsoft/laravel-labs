<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{

    /**
     * @test
     * Test New Orders
     */
    public function order_has_products(){

        // instantiate order class
        $order = new Order;

        // create products
        $product = new Product('Fish',30);
        $product2 = new Product('Chicken',24);

        // add products to order
        $order->add($product);
        $order->add($product2);

        // assert to see if order has 2 products
//        $this->assertEquals(2,count($order->products()));
        $this->assertCount(2,$order->products());
    }
}
