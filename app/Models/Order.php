<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_amount', 'payment_method', 'order_number', 'address_1', 'address_2', 'city', 'country', 'postal_code'];

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\OrderDetail');
    }
}
