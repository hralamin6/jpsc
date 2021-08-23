<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'stock_amount',
        'sell_amount',
    ];

    use HasFactory;
    public function sells()
    {
        return $this->hasMany(Sell::class)->where('status', '=', 'active');
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class)->where('status', '=', 'active');
    }

}
