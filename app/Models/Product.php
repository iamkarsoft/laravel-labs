<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $name ;
    protected $price;

    protected $guarded = [];

    public function __construct($name,$price)
    {
        $this->name=$name;
        $this->price=$price;
    }

    public function name(){
        return $this->name;
    }

    public function price(){
        return $this->price;
    }

}
