<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHasProduct extends Model
{
    protected $table = 'order_has_products';
    protected $primary_key = 'id';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
