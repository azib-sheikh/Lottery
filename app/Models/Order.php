<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id', 'order_number', 'sub_total', 'quantity', 'delivery_charge', 'status', 'total_amount', 'first_name', 'last_name', 'country', 'post_code', 'address1', 'address2', 'phone', 'email', 'payment_method', 'payment_status', 'shipping_id', 'coupon'];


    /**
     * Get the lottery that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'lottery_id', 'id');
    }


    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
