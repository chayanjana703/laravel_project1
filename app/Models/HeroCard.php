<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroCard extends Model
{
    use HasFactory;

    protected $table = 'hero_cards';

    protected $fillable = [
        'section',
        'title',
        'subtitle',
        'badge',
        'price',
        'old_price',
        'rating',
        'image',
        'product_id',
        'sort_order',
        'status',
    ];

    /**
     * Optional relationship to a Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
