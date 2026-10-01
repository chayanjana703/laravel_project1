<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentlyViewed extends Model
{
    use HasFactory;

    protected $table = 'recently_viewed';

    protected $fillable = [
        'session_id',
        'user_id',
        'product_id',
        'viewed_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
