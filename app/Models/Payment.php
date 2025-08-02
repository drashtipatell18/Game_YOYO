<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'cart_id',
        'price',
        'payment_status',
        'razorpay_payment_id',
        'payment_type',
        'exe_url', // Added exe_url to store the path to the .exe file
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cartItems()
    {
        $cartIds = explode(',', $this->cart_id);
        return AddToCart::whereIn('id', $cartIds)->get();
    }

}
