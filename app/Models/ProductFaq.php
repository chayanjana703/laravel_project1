<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFaq extends Model
{
    use HasFactory;

    protected $table = 'product_faqs';

    protected $fillable = [
        'product_id',
        'question',
        'answer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
