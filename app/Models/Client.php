<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'item',
        'payment_amount',
        'months_to_pay',
        'start_month',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
