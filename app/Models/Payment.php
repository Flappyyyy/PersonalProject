<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'client_id',
        'month',
        'year',
        'day_15_amount',
        'day_30_amount',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
