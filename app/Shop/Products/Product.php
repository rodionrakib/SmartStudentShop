<?php

namespace App\Shop\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany('App\Shop\Products\ProductImage');
    }
}
