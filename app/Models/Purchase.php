<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'product_id',
        'category_id',
        'user_id',
        'quantity',
        'kg',
        'unit_price',
        'paid_price',
        'total_price',
        'due_price',
    ];

    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
