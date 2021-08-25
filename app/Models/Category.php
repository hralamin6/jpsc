<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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
