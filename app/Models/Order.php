<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // expects array
    protected $products = [];

    public function add(Product $product)
    {
        // push added product into array
        $this->products[] = $product;
    }

    public function products()
    {
        return $this->products;
    }

    public function total(){
        return 54;
    }
}
