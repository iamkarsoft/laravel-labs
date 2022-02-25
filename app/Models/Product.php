<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $name='Fallout 4' ;

    protected $guarded = [];

    public function __construct($name)
    {
        $this->name=$name;
    }

    public function name(){
        return $this->name;
    }

}
