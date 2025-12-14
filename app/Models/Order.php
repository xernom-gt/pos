<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    protected $fillable = [
        'invoice',
        'total',
        'user_id',
        'customer_id'
    ];

    // RELASI KE MEMBER (bukan customer)
    public function customer()
    {
        return $this->belongsTo(Member::class, 'customer_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
