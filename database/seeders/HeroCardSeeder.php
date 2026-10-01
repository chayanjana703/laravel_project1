<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroCard;
use App\Models\Product;

class HeroCardSeeder extends Seeder
{
    public function run(): void
    {
        HeroCard::truncate();

        // 1. HERO CAROUSEL ITEMS (Column 1 Floating Card)
        $heroProducts = [
            [
                'section' => 'hero_carousel',
                'title' => 'Sony WH-1000XM5 Headphones',
                'subtitle' => 'Industry-leading Noise Canceling',
                'badge' => 'Hot Pick',
                'price' => 29990.00,
                'old_price' => 34990.00,
                'rating' => '4.9',
                'image' => 'uploads/products/product_1_1.jpg',
                'product_id' => 1,
                'sort_order' => 1,
            ],
            [
                'section' => 'hero_carousel',
                'title' => 'Apple MacBook Pro 16" M3 Max',
                'subtitle' => 'Liquid Retina XDR & 36GB RAM',
                'badge' => 'Power Pick',
                'price' => 349900.00,
                'old_price' => 369900.00,
                'rating' => '5.0',
                'image' => 'uploads/products/product_7_14.jpg',
                'product_id' => 7,
                'sort_order' => 2,
            ],
            [
                'section' => 'hero_carousel',
                'title' => 'AirPods Pro (2nd Gen)',
                'subtitle' => 'Adaptive Audio & MagSafe USB-C',
                'badge' => 'Best Seller',
                'price' => 24900.00,
                'old_price' => 26900.00,
                'rating' => '4.95',
                'image' => 'uploads/products/product_2_4.jpg',
                'product_id' => 2,
                'sort_order' => 3,
            ],
            [
                'section' => 'hero_carousel',
                'title' => 'Sony PlayStation 5 Slim',
                'subtitle' => '4K 120Hz Gaming with 1TB SSD',
                'badge' => 'Gaming Pick',
                'price' => 54990.00,
                'old_price' => 59990.00,
                'rating' => '4.85',
                'image' => 'uploads/products/product_14_29.jpg',
                'product_id' => 14,
                'sort_order' => 4,
            ],
        ];

        // 2. FLASH SALE DEALS (Column 2 Top Card)
        $flashSaleDeals = [
            [
                'section' => 'flash_sale',
                'title' => 'Great Value Deals',
                'subtitle' => 'Studio Pro ANC Headphones with Lossless Audio',
                'badge' => 'FLASHSALE 50% OFF',
                'price' => 24999.00,
                'old_price' => 34999.00,
                'rating' => '🏷️ 4.9 Rating',
                'image' => 'uploads/products/product_1_1.jpg',
                'product_id' => 1,
                'sort_order' => 1,
            ],
            [
                'section' => 'flash_sale',
                'title' => 'RTX 4090 Flagship GPU',
                'subtitle' => 'GeForce RTX Liquid Cooled Flagship GPU',
                'badge' => 'LIMITED PROMO 20% OFF',
                'price' => 199990.00,
                'old_price' => 219990.00,
                'rating' => '🏷️ 4.95 Rating',
                'image' => 'uploads/products/product_13_27.jpg',
                'product_id' => 13,
                'sort_order' => 2,
            ],
            [
                'section' => 'flash_sale',
                'title' => 'Samsung S24 Ultra 5G',
                'subtitle' => 'Galaxy AI 200MP Quad Telephoto Camera',
                'badge' => 'SPECIAL OFFER ₹10,000 OFF',
                'price' => 139999.00,
                'old_price' => 144999.00,
                'rating' => '🏷️ 4.9 Rating',
                'image' => 'uploads/products/product_20_41.jpg',
                'product_id' => 20,
                'sort_order' => 3,
            ],
            [
                'section' => 'flash_sale',
                'title' => 'Apple Watch Ultra 2',
                'subtitle' => '49mm Titanium Case & 3000 Nits Display',
                'badge' => 'HOT DEAL DISCOUNTS',
                'price' => 89900.00,
                'old_price' => 94900.00,
                'rating' => '🏷️ 4.85 Rating',
                'image' => 'uploads/products/product_23_47.jpg',
                'product_id' => 23,
                'sort_order' => 4,
            ],
        ];

        // 3. EXCLUSIVE RELEASES (Column 2 Bottom Split Card)
        $exclusiveReleases = [
            [
                'section' => 'exclusive_release',
                'title' => 'NVIDIA GeForce RTX 4090',
                'subtitle' => 'Next-gen liquid cooling graphics architecture.',
                'badge' => 'EXCLUSIVE RELEASE',
                'price' => 199990.00,
                'old_price' => 219990.00,
                'rating' => '5.0',
                'image' => 'uploads/products/product_13_27.jpg',
                'product_id' => 13,
                'sort_order' => 1,
            ],
            [
                'section' => 'exclusive_release',
                'title' => 'Keychron Q1 Pro Custom Keyboard',
                'subtitle' => 'Full CNC aluminum custom hotswap mechanical keyboard.',
                'badge' => 'LIMITED DROPS',
                'price' => 18990.00,
                'old_price' => 20990.00,
                'rating' => '4.9',
                'image' => 'uploads/products/product_17_35.jpg',
                'product_id' => 17,
                'sort_order' => 2,
            ],
            [
                'section' => 'exclusive_release',
                'title' => 'Herman Miller Embody Chair',
                'subtitle' => 'Logitech G Ergonomic pixelated matrix gaming chair.',
                'badge' => 'SPECIAL EDITION',
                'price' => 165000.00,
                'old_price' => 175000.00,
                'rating' => '5.0',
                'image' => 'uploads/products/product_31_64.jpg',
                'product_id' => 31,
                'sort_order' => 3,
            ],
            [
                'section' => 'exclusive_release',
                'title' => 'Canon EOS R6 Mark II',
                'subtitle' => 'Full-frame mirrorless camera with 40fps burst.',
                'badge' => 'FLAGSHIP PICK',
                'price' => 215995.00,
                'old_price' => 229995.00,
                'rating' => '4.95',
                'image' => 'uploads/products/product_26_53.jpg',
                'product_id' => 26,
                'sort_order' => 4,
            ],
        ];

        // 4. FOCUS CARD (Column 2 Bottom Right Card)
        $focusCard = [
            [
                'section' => 'focus_card',
                'title' => 'Apple AirPods Pro (2nd Gen) with MagSafe Case (USB-C)',
                'subtitle' => 'Adaptive Audio & Noise Cancellation',
                'badge' => 'FEATURED ITEM',
                'price' => 24900.00,
                'old_price' => 26900.00,
                'rating' => '4.95',
                'image' => 'uploads/products/product_2_4.jpg',
                'product_id' => 2,
                'sort_order' => 1,
            ],
        ];

        foreach (array_merge($heroProducts, $flashSaleDeals, $exclusiveReleases, $focusCard) as $item) {
            HeroCard::create($item);
        }
    }
}
