<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidAmount extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
    ];

    use HasFactory;
    public function sell()
    {
        return $this->belongsTo(Sell::class);
    }
}
