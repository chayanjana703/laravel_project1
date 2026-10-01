<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productsData = [
            [
                'name' => 'Studio Pro ANC Wireless Headphones',
                'price' => 24999,
                'old_price' => 29999,
                'category_id' => 1, // Audio
                'sku' => 'SKU-AUD-001',
                'description' => 'Lossless acoustic precision with active noise cancellation and 50-hour battery life.',
                'stock' => 25,
                'images' => [
                    'headphones_light_1785685332978.jpg',
                    'wireless_headphones_1785685017731.jpg',
                    'earbuds_light_1785685374769.jpg',
                    'wireless_earbuds_1785685062848.jpg'
                ]
            ],
            [
                'name' => 'Titanium Ultra Fitness Smartwatch',
                'price' => 39999,
                'old_price' => 45999,
                'category_id' => 4, // Tech
                'sku' => 'SKU-WCH-002',
                'description' => 'Aerospace titanium casing with sapphire crystal glass display and advanced bio-tracking.',
                'stock' => 15,
                'images' => [
                    'smartwatch_light_1785685347961.jpg',
                    'smart_watch_1785685032842.jpg',
                    'headphones_light_1785685332978.jpg',
                    'earbuds_light_1785685374769.jpg'
                ]
            ],
            [
                'name' => 'Cyberboard RGB Mechanical Keyboard',
                'price' => 14999,
                'old_price' => 18999,
                'category_id' => 2, // Gaming
                'sku' => 'SKU-KEY-003',
                'description' => 'Hot-swappable mechanical switches with custom dynamic RGB illumination profiles.',
                'stock' => 30,
                'images' => [
                    'keyboard_light_1785685361995.jpg',
                    'mechanical_keyboard_1785685046930.jpg',
                    'gpu_card_1785685874703.jpg',
                    'smartwatch_light_1785685347961.jpg'
                ]
            ],
            [
                'name' => 'ClearPod Glass Wireless Earbuds',
                'price' => 12999,
                'old_price' => 15999,
                'category_id' => 1, // Audio
                'sku' => 'SKU-AUD-004',
                'description' => 'Transparent glass charging case with high-fidelity spatial audio and active noise cancellation.',
                'stock' => 40,
                'images' => [
                    'earbuds_light_1785685374769.jpg',
                    'wireless_earbuds_1785685062848.jpg',
                    'headphones_light_1785685332978.jpg',
                    'smart_watch_1785685032842.jpg'
                ]
            ],
            [
                'name' => 'GeForce RTX Liquid Cooled GPU',
                'price' => 74999,
                'old_price' => 89999,
                'category_id' => 2, // Gaming
                'sku' => 'SKU-GPU-005',
                'description' => 'Flagship ray tracing graphics architecture with custom white liquid cooling block.',
                'stock' => 8,
                'images' => [
                    'gpu_card_1785685874703.jpg',
                    'keyboard_light_1785685361995.jpg',
                    'mechanical_keyboard_1785685046930.jpg',
                    'headphones_light_1785685332978.jpg'
                ]
            ],
            [
                'name' => 'Curved Bouclé Long Lounge Chair',
                'price' => 39999,
                'old_price' => 49999,
                'category_id' => 3, // Furniture
                'sku' => 'SKU-FUR-006',
                'description' => 'Sculpted modern lounge seating crafted with tactile bouclé fabric & solid oak frame.',
                'stock' => 12,
                'images' => [
                    'sofa_long_chair_1785685514802.jpg',
                    'armchair_white_1785685529905.jpg',
                    'focus_chair_1785685546730.jpg',
                    'nest_table_1785685562313.jpg'
                ]
            ],
            [
                'name' => 'Nordic Cream Sculpted Armchair',
                'price' => 32999,
                'old_price' => 38999,
                'category_id' => 3, // Furniture
                'sku' => 'SKU-FUR-007',
                'description' => 'Minimalist Scandinavian armchair with sculpted wooden armrests and high-density foam.',
                'stock' => 10,
                'images' => [
                    'armchair_white_1785685529905.jpg',
                    'focus_chair_1785685546730.jpg',
                    'sofa_long_chair_1785685514802.jpg',
                    'nest_table_1785685562313.jpg'
                ]
            ],
            [
                'name' => 'Organic Nest Solid Wood Coffee Table',
                'price' => 22999,
                'old_price' => 27999,
                'category_id' => 3, // Furniture
                'sku' => 'SKU-FUR-008',
                'description' => 'Organic shaped natural oak wood centerpiece table with smooth matte protective coating.',
                'stock' => 18,
                'images' => [
                    'nest_table_1785685562313.jpg',
                    'sofa_long_chair_1785685514802.jpg',
                    'armchair_white_1785685529905.jpg',
                    'focus_chair_1785685546730.jpg'
                ]
            ],
            [
                'name' => 'Ergonomic Mesh Task Office Chair',
                'price' => 28999,
                'old_price' => 34999,
                'category_id' => 3, // Furniture
                'sku' => 'SKU-FUR-009',
                'description' => 'Breathable mesh backrest with 4D adjustable lumbar support and synchronized tilt.',
                'stock' => 20,
                'images' => [
                    'focus_chair_1785685546730.jpg',
                    'armchair_white_1785685529905.jpg',
                    'sofa_long_chair_1785685514802.jpg',
                    'nest_table_1785685562313.jpg'
                ]
            ],
            [
                'name' => 'Pro Studio Wireless Headphones Edition',
                'price' => 26999,
                'old_price' => 31999,
                'category_id' => 1, // Audio
                'sku' => 'SKU-AUD-010',
                'description' => 'Premium audiophile studio headphones with neodymium drivers and memory foam cups.',
                'stock' => 14,
                'images' => [
                    'wireless_headphones_1785685017731.jpg',
                    'headphones_light_1785685332978.jpg',
                    'earbuds_light_1785685374769.jpg',
                    'wireless_earbuds_1785685062848.jpg'
                ]
            ],
            [
                'name' => 'Custom Tactile Mechanical Keyboard',
                'price' => 16999,
                'old_price' => 19999,
                'category_id' => 2, // Gaming
                'sku' => 'SKU-KEY-011',
                'description' => 'Brass plate gasket-mounted mechanical keyboard with PBT keycaps.',
                'stock' => 22,
                'images' => [
                    'mechanical_keyboard_1785685046930.jpg',
                    'keyboard_light_1785685361995.jpg',
                    'gpu_card_1785685874703.jpg',
                    'smart_watch_1785685032842.jpg'
                ]
            ],
            [
                'name' => 'Smart Bio-Fitness Wristband',
                'price' => 18999,
                'old_price' => 22999,
                'category_id' => 4, // Tech
                'sku' => 'SKU-WCH-012',
                'description' => 'Continuous HR monitoring, sleep tracking, and built-in GPS with 14-day battery.',
                'stock' => 35,
                'images' => [
                    'smart_watch_1785685032842.jpg',
                    'smartwatch_light_1785685347961.jpg',
                    'headphones_light_1785685332978.jpg',
                    'earbuds_light_1785685374769.jpg'
                ]
            ],
            [
                'name' => 'Spatial Studio In-Ear Pods',
                'price' => 11499,
                'old_price' => 13999,
                'category_id' => 1, // Audio
                'sku' => 'SKU-AUD-013',
                'description' => 'Ultra-lightweight wireless earbuds with low latency gaming mode.',
                'stock' => 50,
                'images' => [
                    'wireless_earbuds_1785685062848.jpg',
                    'earbuds_light_1785685374769.jpg',
                    'headphones_light_1785685332978.jpg',
                    'wireless_headphones_1785685017731.jpg'
                ]
            ],
            [
                'name' => 'Asus ROG Gaming Laptop i9 RTX 4080',
                'price' => 145000,
                'old_price' => 165000,
                'category_id' => 2, // Gaming
                'sku' => 'SKU-LAP-014',
                'description' => 'High-performance gaming laptop with 240Hz Nebula Display and Intel Core i9 processor.',
                'stock' => 6,
                'images' => [
                    'gpu_card_1785685874703.jpg',
                    'keyboard_light_1785685361995.jpg',
                    'mechanical_keyboard_1785685046930.jpg',
                    'headphones_light_1785685332978.jpg'
                ]
            ],
            [
                'name' => 'Minimalist Walnut Center Coffee Table',
                'price' => 25999,
                'old_price' => 31999,
                'category_id' => 3, // Furniture
                'sku' => 'SKU-FUR-015',
                'description' => 'American solid walnut construction with soft rounded edges.',
                'stock' => 14,
                'images' => [
                    'nest_table_1785685562313.jpg',
                    'sofa_long_chair_1785685514802.jpg',
                    'armchair_white_1785685529905.jpg',
                    'focus_chair_1785685546730.jpg'
                ]
            ],
            [
                'name' => 'Pro Wireless RGB Gaming Mouse',
                'price' => 8999,
                'old_price' => 11999,
                'category_id' => 2, // Gaming
                'sku' => 'SKU-GME-016',
                'description' => '30K DPI optical sensor with 60g ultra-lightweight chassis.',
                'stock' => 45,
                'images' => [
                    'mechanical_keyboard_1785685046930.jpg',
                    'keyboard_light_1785685361995.jpg',
                    'gpu_card_1785685874703.jpg',
                    'earbuds_light_1785685374769.jpg'
                ]
            ],
            [
                'name' => 'High-Fidelity Studio Monitor Speakers',
                'price' => 34999,
                'old_price' => 41999,
                'category_id' => 1, // Audio
                'sku' => 'SKU-AUD-017',
                'description' => 'Bi-amplified active studio monitors with flat frequency response curve.',
                'stock' => 11,
                'images' => [
                    'headphones_light_1785685332978.jpg',
                    'wireless_headphones_1785685017731.jpg',
                    'earbuds_light_1785685374769.jpg',
                    'wireless_earbuds_1785685062848.jpg'
                ]
            ],
            [
                'name' => 'Executive Leather Ergonomic Recliner',
                'price' => 48999,
                'old_price' => 59999,
                'category_id' => 3, // Furniture
                'sku' => 'SKU-FUR-018',
                'description' => 'Top-grain Italian leather office recliner with adjustable footrest.',
                'stock' => 7,
                'images' => [
                    'armchair_white_1785685529905.jpg',
                    'sofa_long_chair_1785685514802.jpg',
                    'focus_chair_1785685546730.jpg',
                    'nest_table_1785685562313.jpg'
                ]
            ],
            [
                'name' => '34 Curved OLED Gaming Display',
                'price' => 89999,
                'old_price' => 105000,
                'category_id' => 2, // Gaming
                'sku' => 'SKU-DIS-019',
                'description' => '175Hz Ultrawide QD-OLED panel with 0.03ms response time.',
                'stock' => 9,
                'images' => [
                    'gpu_card_1785685874703.jpg',
                    'keyboard_light_1785685361995.jpg',
                    'mechanical_keyboard_1785685046930.jpg',
                    'headphones_light_1785685332978.jpg'
                ]
            ],
            [
                'name' => 'Aluminum Dual Laptop & Tablet Stand',
                'price' => 4999,
                'old_price' => 6999,
                'category_id' => 4, // Tech
                'sku' => 'SKU-ACC-020',
                'description' => 'CNC machined anodized aluminum vertical desktop stand for MacBook & iPad.',
                'stock' => 60,
                'images' => [
                    'smartwatch_light_1785685347961.jpg',
                    'smart_watch_1785685032842.jpg',
                    'keyboard_light_1785685361995.jpg',
                    'gpu_card_1785685874703.jpg'
                ]
            ],
            [
                'name' => 'Fast MagSafe Wireless Charging Hub',
                'price' => 7999,
                'old_price' => 9999,
                'category_id' => 4, // Tech
                'sku' => 'SKU-ACC-021',
                'description' => '3-in-1 15W fast wireless charging station for iPhone, Apple Watch & AirPods.',
                'stock' => 50,
                'images' => [
                    'earbuds_light_1785685374769.jpg',
                    'wireless_earbuds_1785685062848.jpg',
                    'smartwatch_light_1785685347961.jpg',
                    'smart_watch_1785685032842.jpg'
                ]
            ]
        ];

        foreach ($productsData as $data) {
            // Assign seller_id based on category: 1=Audio/Tech (Seller 1), 2=Gaming (Seller 2), 3=Furniture (Seller 3), 4=Tech (Seller 1)
            $sellerIdMap = [
                1 => 1, // TechAura Electronics
                2 => 2, // NextGen Gaming Studio
                3 => 3, // Nordic Living & Furniture
                4 => 1, // TechAura Electronics
            ];
            $sellerId = $sellerIdMap[$data['category_id']] ?? 1;

            $product = Product::updateOrCreate(
                ['sku' => $data['sku']],
                [
                    'seller_id' => $sellerId,
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']),
                    'price' => $data['price'],
                    'old_price' => $data['old_price'],
                    'category_id' => $data['category_id'],
                    'description' => $data['description'],
                    'stock' => $data['stock'],
                    'status' => 1,
                    'featured' => 1,
                ]
            );

            // Re-create product images (4 per product)
            $product->images()->delete();
            foreach ($data['images'] as $idx => $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $img,
                    'is_primary' => ($idx === 0) ? 1 : 0,
                ]);
            }
        }
    }
}
