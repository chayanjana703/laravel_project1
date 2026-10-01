<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\ProductReview;
use App\Models\ProductFaq;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Seed Specifications if empty
            if ($product->specifications()->count() === 0) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'spec_key' => 'Model Name',
                    'spec_value' => $product->name,
                ]);
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'spec_key' => 'Connectivity',
                    'spec_value' => 'Bluetooth 5.3 & Ultra-low Latency Wireless',
                ]);
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'spec_key' => 'Battery & Power',
                    'spec_value' => 'Up to 50 Hours Continuous Battery Life',
                ]);
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'spec_key' => 'Noise Cancellation',
                    'spec_value' => 'Hybrid Active Noise Cancellation (ANC)',
                ]);
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'spec_key' => 'Warranty Summary',
                    'spec_value' => '2 Year Official Brand Replacement Warranty',
                ]);
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'spec_key' => 'In The Box',
                    'spec_value' => 'Main Unit, Travel Case, USB-C Fast Charger, User Guide',
                ]);
            }

            // Seed Reviews if empty
            if ($product->reviews()->count() === 0) {
                ProductReview::create([
                    'product_id' => $product->id,
                    'user_name' => 'Alex Johnson',
                    'rating' => 5,
                    'comment' => 'Unbelievable build quality and crisp sound! Highly recommended.',
                    'is_verified' => true,
                ]);
                ProductReview::create([
                    'product_id' => $product->id,
                    'user_name' => 'Sophia Martinez',
                    'rating' => 5,
                    'comment' => 'Exceeded my expectations! Super comfortable for long daily use.',
                    'is_verified' => true,
                ]);
                ProductReview::create([
                    'product_id' => $product->id,
                    'user_name' => 'Michael Chen',
                    'rating' => 4,
                    'comment' => 'Great performance and elegant aesthetic. Battery life is fantastic.',
                    'is_verified' => true,
                ]);
            }

            // Seed FAQs if empty
            if ($product->faqs()->count() === 0) {
                ProductFaq::create([
                    'product_id' => $product->id,
                    'question' => 'Does this item include multi-device pairing support?',
                    'answer' => 'Yes, it features Multipoint technology allowing seamless auto-switching between device profiles.',
                ]);
                ProductFaq::create([
                    'product_id' => $product->id,
                    'question' => 'What is included in the package box?',
                    'answer' => 'The box includes the main unit, protective travel case, USB-C charging cable, and user documentation.',
                ]);
                ProductFaq::create([
                    'product_id' => $product->id,
                    'question' => 'How long is the manufacturer warranty valid?',
                    'answer' => 'You receive a 2-Year Official Brand Warranty with hassle-free doorstep replacement coverage.',
                ]);
            }
        }
    }
}
