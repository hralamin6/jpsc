<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function sell()
    {
        return $this->hasMany(Sell::class);
    }
    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }
}
