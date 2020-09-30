<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primary_key = 'id';
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(OrderHasProduct::class, 'order_id', 'id');
    }
}
