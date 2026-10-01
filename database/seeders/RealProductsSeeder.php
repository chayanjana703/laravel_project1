<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use App\Models\ProductReview;
use App\Models\ProductFaq;
use Illuminate\Support\Str;

class RealProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate existing product data to start completely fresh
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        ProductFaq::truncate();
        ProductReview::truncate();
        ProductSpecification::truncate();
        ProductImage::truncate();
        Product::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $productsData = [
            // 1
            [
                'name' => 'Sony WH-1000XM5 Wireless Noise Canceling Headphones',
                'price' => 29990.00,
                'old_price' => 34990.00,
                'stock' => 25,
                'description' => 'The WH-1000XM5 headphones rewrite the rules for distraction-free listening with 8 microphones, Auto NC Optimizer, and custom 30mm driver unit. Industry-leading noise canceling powered by two processors.',
                'images' => [
                    'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1583394838336-acd977736f90?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1484704849700-f032a568e944?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Driver Unit' => '30mm Carbon Fiber Dome',
                    'Battery Life' => 'Up to 30 Hours (NC ON)',
                    'Microphones' => '8 Mics with Beamforming',
                    'Noise Cancellation' => 'Dual Processor Auto NC Optimizer',
                    'Connectivity' => 'Bluetooth 5.2, Multipoint, 3.5mm Aux'
                ],
                'reviews' => [
                    ['user_name' => 'Vikram Sethi', 'rating' => 5, 'comment' => 'Unbelievable noise cancellation! Perfect for long flights and noisy office environments.'],
                    ['user_name' => 'Ananya Sharma', 'rating' => 5, 'comment' => 'Super lightweight and the soundstage is balanced and detailed.'],
                    ['user_name' => 'Rahul Nair', 'rating' => 4, 'comment' => 'Great headphones, mic quality for calls is crystal clear. Highly recommended!']
                ],
                'faqs' => [
                    ['question' => 'Does it support simultaneous connection to two devices?', 'answer' => 'Yes, multipoint connection lets you pair with two Bluetooth devices at the same time.'],
                    ['question' => 'What is included in the box?', 'answer' => 'Headphones, collapsible carrying case, 3.5mm audio cable, and USB-C charging cable.']
                ]
            ],
            // 2
            [
                'name' => 'Apple AirPods Pro (2nd Gen) with MagSafe Case (USB-C)',
                'price' => 24900.00,
                'old_price' => 26900.00,
                'stock' => 40,
                'description' => 'Re-engineered for richer audio experiences. Next-level Active Noise Cancellation and Adaptive Transparency reduce external noise. Spatial Audio takes immersion to a personal level.',
                'images' => [
                    'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Chip' => 'Apple H2 Headphone Chip',
                    'Battery Life' => '6 Hours single charge (30 Hours with Case)',
                    'Charging Case' => 'MagSafe Charging Case (USB-C) with Speaker & Lanyard Loop',
                    'Water Resistance' => 'IP54 Sweat and Dust Resistant',
                    'Noise Control' => 'Active Noise Cancellation, Adaptive Audio, Conversation Awareness'
                ],
                'reviews' => [
                    ['user_name' => 'Priya Mehta', 'rating' => 5, 'comment' => 'The USB-C upgrade makes cable management so easy. Audio quality is phenomenal.'],
                    ['user_name' => 'Karan Malhotra', 'rating' => 5, 'comment' => 'Conversation awareness feature works like magic when talking to colleagues.']
                ],
                'faqs' => [
                    ['question' => 'Are silicone ear tips included in multiple sizes?', 'answer' => 'Yes, 4 pairs of silicone tips (XS, S, M, L) are included in the box.'],
                    ['question' => 'Does the case support Find My precision tracking?', 'answer' => 'Yes, the U1 chip in the MagSafe case enables Precision Finding with built-in speaker chime.']
                ]
            ],
            // 3
            [
                'name' => 'Bose QuietComfort Ultra Headphones',
                'price' => 35900.00,
                'old_price' => 38900.00,
                'stock' => 18,
                'description' => 'World-class noise cancellation, quieter than ever before. Breakthrough spatialized audio for more immersive listening no matter the content or source.',
                'images' => [
                    'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Spatial Audio' => 'Bose Immersive Audio Modes',
                    'Battery Life' => 'Up to 24 Hours continuous playback',
                    'Microphones' => 'Revolutionary mic array for clear voice pickup',
                    'Modes' => 'Quiet Mode, Aware Mode, Immersion Mode',
                    'App Support' => 'Bose Music App with EQ controls'
                ],
                'reviews' => [
                    ['user_name' => 'Siddharth Roy', 'rating' => 5, 'comment' => 'Bose comfort is legendary. Wore these for an 11-hour flight with zero fatigue.'],
                    ['user_name' => 'Divya K.', 'rating' => 4, 'comment' => 'Immersion mode creates a surprisingly wide soundstage for stereo tracks.']
                ],
                'faqs' => [
                    ['question' => 'Can I use them wired if the battery dies?', 'answer' => 'Yes, an audio cable is included to use them in passive wired mode.']
                ]
            ],
            // 4
            [
                'name' => 'Sennheiser Momentum 4 Wireless Headphones',
                'price' => 26990.00,
                'old_price' => 29990.00,
                'stock' => 15,
                'description' => 'Delivering Sennheiser signature sound with audiophile-inspired 42mm transducer system. Massive 60-hour battery life and adaptive noise cancellation.',
                'images' => [
                    'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1583394838336-acd977736f90?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Battery Life' => '60 Hours (Unmatched Class Leader)',
                    'Transducer' => '42mm Dynamic System',
                    'Codecs' => 'aptX Adaptive, AAC, SBC',
                    'Fast Charge' => '5 Mins charge gives 4 Hours playback',
                    'Design' => 'Fold-flat design with premium fabric headband'
                ],
                'reviews' => [
                    ['user_name' => 'Rohan Gupta', 'rating' => 5, 'comment' => '60-hour battery life is real! I only charge these once every two weeks.'],
                    ['user_name' => 'Meera Bose', 'rating' => 5, 'comment' => 'The sound profile is so natural and acoustic. Classical music sounds breathtaking.']
                ],
                'faqs' => [
                    ['question' => 'Does it support high resolution audio codecs?', 'answer' => 'Yes, it supports Qualcomm aptX Adaptive for high resolution low-latency sound.']
                ]
            ],
            // 5
            [
                'name' => 'JBL Flip 6 Waterproof Portable Bluetooth Speaker',
                'price' => 9999.00,
                'old_price' => 13999.00,
                'stock' => 50,
                'description' => 'Louder, more powerful sound with 2-way speaker system designed to deliver loud, crystal clear, powerful audio. IP67 waterproof and dustproof design.',
                'images' => [
                    'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1545454675-3531b543be5d?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Output Power' => '20W RMS Woofer + 10W RMS Tweeter',
                    'Protection' => 'IP67 Waterproof and Dustproof',
                    'Battery Life' => '12 Hours Music Playback',
                    'Feature' => 'PartyBoost for multi-speaker pairing',
                    'Weight' => '550 grams'
                ],
                'reviews' => [
                    ['user_name' => 'Varun Tandon', 'rating' => 5, 'comment' => 'Punchy bass and outdoor volume is insane for such a small speaker!'],
                    ['user_name' => 'Neha Kapoor', 'rating' => 4, 'comment' => 'Took it pool side all weekend, water splashes did nothing to it. Perfect outdoor companion.']
                ],
                'faqs' => [
                    ['question' => 'Can I connect multiple JBL speakers together?', 'answer' => 'Yes, JBL PartyBoost allows you to pair two compatible JBL speakers together for stereo sound.']
                ]
            ],
            // 6
            [
                'name' => 'Sonos Era 300 Smart Speaker with Dolby Atmos',
                'price' => 54999.00,
                'old_price' => 59999.00,
                'stock' => 10,
                'description' => 'Featuring six optimally positioned drivers all around the front, sides, and top to support Dolby Atmos Spatial Audio. Breakthrough acoustic architecture projects sound wall-to-wall.',
                'images' => [
                    'https://images.unsplash.com/photo-1545454675-3531b543be5d?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Amplifiers' => '6 Class-D Digital Amplifiers',
                    'Audio Format' => 'Dolby Atmos Spatial Audio',
                    'Connectivity' => 'Wi-Fi 6, Bluetooth 5.0, USB-C Line-In',
                    'Voice Assistants' => 'Sonos Voice Control, Amazon Alexa',
                    'Tuning' => 'Trueplay room tuning tech'
                ],
                'reviews' => [
                    ['user_name' => 'Amitabh Sen', 'rating' => 5, 'comment' => 'Dolby Atmos spatial audio fills the entire room. Feels like music floating around you.']
                ],
                'faqs' => [
                    ['question' => 'Does Trueplay tuning work on Android?', 'answer' => 'Trueplay quick tuning works on both iOS and supported Android devices.']
                ]
            ],
            // 7
            [
                'name' => 'Apple MacBook Pro 16" (M3 Max, 36GB RAM, 1TB SSD) - Space Black',
                'price' => 349900.00,
                'old_price' => 369900.00,
                'stock' => 8,
                'description' => 'Mind-blowing performance with the M3 Max chip featuring a 16-core CPU and 40-core GPU. Liquid Retina XDR display with 1600 nits peak brightness and up to 22 hours battery life.',
                'images' => [
                    'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'Apple M3 Max (16-Core CPU, 40-Core GPU)',
                    'Unified Memory' => '36GB Unified RAM',
                    'Storage' => '1TB NVMe Superfast SSD',
                    'Display' => '16.2-inch Liquid Retina XDR (3456 x 2234, 120Hz ProMotion)',
                    'Ports' => '3x Thunderbolt 4, HDMI, SDXC, MagSafe 3, Headphone Jack'
                ],
                'reviews' => [
                    ['user_name' => 'Deepak Verma', 'rating' => 5, 'comment' => 'Renders 8K video timelines instantly without fans even turning on. Absolute power monster!'],
                    ['user_name' => 'Tarun Reddy', 'rating' => 5, 'comment' => 'The Space Black finish resists fingerprints well and looks sleek. Display is gorgeous.']
                ],
                'faqs' => [
                    ['question' => 'What power adapter is included?', 'answer' => 'Includes a 140W USB-C Power Adapter and USB-C to MagSafe 3 Cable.']
                ]
            ],
            // 8
            [
                'name' => 'Dell XPS 15 OLED Touch Laptop (Intel Core i9 13th Gen, 32GB, 1TB)',
                'price' => 249990.00,
                'old_price' => 269990.00,
                'stock' => 12,
                'description' => 'Precision crafted from CNC aluminum with carbon fiber palm rest. Stunning 3.5K OLED Touch display with 100% DCI-P3 color accuracy and NVIDIA GeForce RTX 4070 Graphics.',
                'images' => [
                    'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'Intel Core i9-13900H (14 Cores, 20 Threads)',
                    'Graphics' => 'NVIDIA GeForce RTX 4070 8GB GDDR6',
                    'RAM' => '32GB DDR5 4800MHz',
                    'Display' => '15.6" 3.5K (3456 x 2160) OLED Touch Display',
                    'Chassis' => 'CNC Machined Aluminum & Carbon Fiber'
                ],
                'reviews' => [
                    ['user_name' => 'Kavita Pillai', 'rating' => 5, 'comment' => 'OLED screen is the best I have ever seen on a laptop for photo editing. Colors pop!']
                ],
                'faqs' => [
                    ['question' => 'Is RAM expandable on this model?', 'answer' => 'Yes, it features 2x SO-DIMM slots expandable up to 64GB DDR5.']
                ]
            ],
            // 9
            [
                'name' => 'ASUS ROG Zephyrus G16 Gaming Laptop (Intel Core Ultra 9, RTX 4080)',
                'price' => 279990.00,
                'old_price' => 299990.00,
                'stock' => 7,
                'description' => 'Ultra-thin gaming powerhouse featuring CNC aluminum unibody, ROG Nebula OLED 240Hz display, and NVIDIA GeForce RTX 4080 Laptop GPU with Advanced Optimus.',
                'images' => [
                    'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'Intel Core Ultra 9 185H (AI-Enabled NPU)',
                    'Graphics' => 'NVIDIA GeForce RTX 4080 12GB (115W TGP)',
                    'Display' => '16" 2.5K 240Hz ROG Nebula OLED (0.2ms response)',
                    'Weight' => 'Ultra-slim 1.85 kg',
                    'Cooling' => 'Tri-Fan Tech & Liquid Metal Thermal Compound'
                ],
                'reviews' => [
                    ['user_name' => 'Sameer Oberoi', 'rating' => 5, 'comment' => 'Runs Cyberpunk 2077 with full ray tracing at 100+ FPS! OLED 240Hz is butter smooth.']
                ],
                'faqs' => [
                    ['question' => 'Does it support USB-C power delivery charging?', 'answer' => 'Yes, it supports up to 100W USB-C charging for portability on the go.']
                ]
            ],
            // 10
            [
                'name' => 'Lenovo ThinkPad X1 Carbon Gen 11 (Intel Core i7 13th Gen, 16GB, 512GB)',
                'price' => 165000.00,
                'old_price' => 179000.00,
                'stock' => 15,
                'description' => 'The gold standard in business laptops. Ultra-lightweight carbon-fiber weave top cover, legendary spill-resistant TrackPoint keyboard, and Intel Evo certification.',
                'images' => [
                    'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'Intel Core i7-1365U vPro Processor',
                    'Memory' => '16GB LPDDR5 6400MHz',
                    'Storage' => '512GB PCIe Gen 4 Performance SSD',
                    'Display' => '14" WUXGA (1920 x 1200) IPS Anti-Glare 400 nits',
                    'Security' => 'Match-on-Chip Fingerprint Reader & IR Camera Privacy Shutter'
                ],
                'reviews' => [
                    ['user_name' => 'Rajesh Joshi', 'rating' => 5, 'comment' => 'Weighs just 1.12kg and battery lasts all day. Best keyboard typing feel ever.']
                ],
                'faqs' => [
                    ['question' => 'Is it MIL-STD 810H military spec tested?', 'answer' => 'Yes, it undergoes 12 MIL-STD 810H standards and over 200 quality checks.']
                ]
            ],
            // 11
            [
                'name' => 'Apple iPad Pro 12.9" M2 Chip (Wi-Fi, 256GB) - Space Grey',
                'price' => 112900.00,
                'old_price' => 122900.00,
                'stock' => 20,
                'description' => 'Astonishing performance and display. Powered by M2 chip with 8-core CPU and 10-core GPU. Liquid Retina XDR display with 2596 full-array local dimming zones.',
                'images' => [
                    'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1561154464-82e9adf32764?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Chip' => 'Apple M2 Chip with Next-Gen Neural Engine',
                    'Display' => '12.9-inch Liquid Retina XDR (mini-LED, ProMotion 120Hz)',
                    'Camera' => '12MP Wide + 10MP Ultra Wide & LiDAR Scanner',
                    'Pencil Support' => 'Supports Apple Pencil (2nd Gen) Hover Feature',
                    'Connectivity' => 'Wi-Fi 6E (802.11ax) & Bluetooth 5.3'
                ],
                'reviews' => [
                    ['user_name' => 'Shweta Rao', 'rating' => 5, 'comment' => 'Digital illustration on Procreate with the Apple Pencil hover feature is unmatched.']
                ],
                'faqs' => [
                    ['question' => 'Does it come with Apple Pencil included?', 'answer' => 'Apple Pencil is sold separately.']
                ]
            ],
            // 12
            [
                'name' => 'Samsung Galaxy Tab S9 Ultra (Wi-Fi, 12GB RAM, 256GB) with S Pen',
                'price' => 108999.00,
                'old_price' => 115999.00,
                'stock' => 14,
                'description' => 'Massive 14.6" Dynamic AMOLED 2X 120Hz display enclosed in Armor Aluminum frame. IP68 water and dust resistance for both tablet and included low-latency S Pen.',
                'images' => [
                    'https://images.unsplash.com/photo-1561154464-82e9adf32764?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'Snapdragon 8 Gen 2 for Galaxy',
                    'Display' => '14.6" Dynamic AMOLED 2X (2960 x 1848, 120Hz)',
                    'Protection' => 'IP68 Water & Dust Resistant',
                    'Stylus' => 'S Pen with 2.8ms ultra-low latency included',
                    'Battery' => '11,200 mAh with 45W Fast Charging'
                ],
                'reviews' => [
                    ['user_name' => 'Gaurav Bhatia', 'rating' => 5, 'comment' => 'Multitasking with Samsung DeX on this huge 14.6" screen feels like a desktop monitor.']
                ],
                'faqs' => [
                    ['question' => 'Is the S Pen included in the tablet box?', 'answer' => 'Yes, IP68 rated S Pen is included in the box at no extra cost.']
                ]
            ],
            // 13
            [
                'name' => 'NVIDIA GeForce RTX 4090 OC Edition 24GB GDDR6X Graphics Card',
                'price' => 199990.00,
                'old_price' => 219990.00,
                'stock' => 5,
                'description' => 'The ultimate GeForce GPU. It brings an enormous leap in performance, efficiency, and AI-powered graphics with DLSS 3 Frame Generation and 3rd Gen RT Cores.',
                'images' => [
                    'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'CUDA Cores' => '16,384 Cores',
                    'VRAM' => '24GB GDDR6X 384-Bit Memory Interface',
                    'Clock Speed' => '2565 MHz Boost Clock',
                    'Power Requirement' => '850W PSU Recommended (16-Pin PCIe 5.0 Power)',
                    'Cooling' => 'Triple Axial Tech Fan Vapor Chamber Design'
                ],
                'reviews' => [
                    ['user_name' => 'Kunal Kapoor', 'rating' => 5, 'comment' => 'Runs 4K 144Hz gaming effortlessly with DLSS 3. The peak of PC hardware technology!']
                ],
                'faqs' => [
                    ['question' => 'What power connector power adapter is included?', 'answer' => 'Includes 1x 16-pin (12VHPWR) to 4x 8-pin PCIe power adapter cable.']
                ]
            ],
            // 14
            [
                'name' => 'Sony PlayStation 5 Console (Slim Disc Edition)',
                'price' => 54990.00,
                'old_price' => 59990.00,
                'stock' => 30,
                'description' => 'Experience lightning fast loading with ultra-high speed SSD, deeper immersion with support for haptic feedback, adaptive triggers, 3D Audio, and 4K 120Hz gaming.',
                'images' => [
                    'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Storage' => '1TB Custom High-Speed NVMe SSD',
                    'Graphics' => 'AMD Radeon RDNA 2-based graphics engine (Ray Tracing)',
                    'Output' => 'Supports 4K 120Hz TVs, 8K TVs, VRR (HDMI 2.1)',
                    'Controller' => 'DualSense Wireless Controller with Haptic Feedback',
                    'Audio' => 'Tempest 3D AudioTech'
                ],
                'reviews' => [
                    ['user_name' => 'Yash Khurana', 'rating' => 5, 'comment' => 'The DualSense haptic triggers in games like Astro Bot are unbelievable!']
                ],
                'faqs' => [
                    ['question' => 'Does this model include a Blu-Ray disc drive?', 'answer' => 'Yes, this is the Disc Edition which plays PS5/PS4 Blu-Ray discs and 4K Ultra HD Blu-Ray movies.']
                ]
            ],
            // 15
            [
                'name' => 'Nintendo Switch OLED Model (Neon Red & Neon Blue Joy-Con)',
                'price' => 28999.00,
                'old_price' => 32999.00,
                'stock' => 22,
                'description' => 'Feast your eyes on vivid colors and crisp contrast with a 7-inch OLED screen. Features a wide adjustable stand, dock with a wired LAN port, and 64 GB internal storage.',
                'images' => [
                    'https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Display' => '7-inch Multi-touch capacitive OLED Screen',
                    'Storage' => '64GB Internal Storage (Expandable up to 2TB microSD)',
                    'Audio' => 'Enhanced onboard stereo speakers',
                    'Dock Ports' => '2x USB 2.0, HDMI, Wired LAN Port',
                    'Battery Life' => '4.5 to 9 Hours depending on game'
                ],
                'reviews' => [
                    ['user_name' => 'Pooja Hegde', 'rating' => 5, 'comment' => 'Zelda Tears of the Kingdom on the 7" OLED screen looks vibrant and sharp.']
                ],
                'faqs' => [
                    ['question' => 'Can I play in handheld, tabletop, and TV mode?', 'answer' => 'Yes, Nintendo Switch OLED supports all 3 gaming modes seamlessly.']
                ]
            ],
            // 16
            [
                'name' => 'Logitech G Pro X Superlight 2 Wireless Gaming Mouse',
                'price' => 14995.00,
                'old_price' => 16995.00,
                'stock' => 35,
                'description' => 'Iconic 60g ultra-lightweight design updated with LIGHTFORCE hybrid optical-mechanical switches, HERO 2 Sensor with sub-micron tracking, and 95 hours battery life.',
                'images' => [
                    'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Weight' => '60g Ultra Lightweight',
                    'Sensor' => 'HERO 2 Sensor (32,000 DPI, 500+ IPS)',
                    'Polling Rate' => 'Up to 2000Hz (0.5ms response time)',
                    'Switches' => 'LIGHTFORCE Hybrid Optical-Mechanical',
                    'Battery Life' => '95 Hours continuous motion'
                ],
                'reviews' => [
                    ['user_name' => 'Nikhil Anand', 'rating' => 5, 'comment' => 'The mouse glides effortlessly in Valorant. Weight balance and sensor accuracy are 10/10.']
                ],
                'faqs' => [
                    ['question' => 'Does it charge via USB-C cable?', 'answer' => 'Yes, Superlight 2 upgrades to USB-C charging and supports Powerplay wireless charging pads.']
                ]
            ],
            // 17
            [
                'name' => 'Keychron Q1 Pro QMK/VIA Wireless Custom Mechanical Keyboard',
                'price' => 18990.00,
                'old_price' => 20990.00,
                'stock' => 18,
                'description' => '75% layout full CNC aluminum mechanical keyboard. Features Double-gasket design, hotswappable PCB, Keychron K Pro switches, and QMK/VIA programmable key mapping.',
                'images' => [
                    'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Body' => 'Full CNC Machined Aluminum Case',
                    'Keycaps' => 'KSA Profile Double-Shot PBT Keycaps',
                    'Switches' => 'Pre-lubed Keychron K Pro Red Mechanical Switches',
                    'Connectivity' => 'Bluetooth 5.1 & Type-C Wired',
                    'Firmware' => 'Open-Source QMK/VIA Key Remapping'
                ],
                'reviews' => [
                    ['user_name' => 'Dhruv Saxena', 'rating' => 5, 'comment' => 'Thocky sound right out of the box! Heavy premium aluminum chassis feels indestructible.']
                ],
                'faqs' => [
                    ['question' => 'Is it compatible with macOS and Windows?', 'answer' => 'Yes, includes dedicated toggle switch and keycaps for both Mac and Windows layouts.']
                ]
            ],
            // 18
            [
                'name' => 'Samsung Odyssey OLED G9 49" Curved Dual QHD Gaming Monitor',
                'price' => 149990.00,
                'old_price' => 169990.00,
                'stock' => 6,
                'description' => 'World’s first 49" Dual QHD OLED curved gaming monitor. Featuring blazing 240Hz refresh rate, 0.03ms response time, Neo Quantum Processor Pro, and 1800R curvature.',
                'images' => [
                    'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1547119957-637f8679db1e?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Screen Size' => '49-inch 32:9 Super Ultra-Wide OLED',
                    'Resolution' => 'Dual QHD (5120 x 1440)',
                    'Refresh Rate' => '240Hz with AMD FreeSync Premium Pro',
                    'Response Time' => '0.03ms (GtG)',
                    'Smart Features' => 'Samsung Gaming Hub & Smart TV Apps Built-In'
                ],
                'reviews' => [
                    ['user_name' => 'Chirag Singhal', 'rating' => 5, 'comment' => 'Replaced two 27" monitors with this. Racing simulators in ultrawide 32:9 are mind blowing.']
                ],
                'faqs' => [
                    ['question' => 'Does it feature DisplayPort and HDMI 2.1?', 'answer' => 'Yes, features DisplayPort 1.4, HDMI 2.1, Micro HDMI 2.1, and USB Hub.']
                ]
            ],
            // 19
            [
                'name' => 'Apple iPhone 15 Pro Max (256GB) - Natural Titanium',
                'price' => 159900.00,
                'old_price' => 164900.00,
                'stock' => 25,
                'description' => 'Forged in titanium featuring the groundbreaking A17 Pro chip, customizable Action button, 48MP main camera system with 5x Telephoto optical zoom, and USB-C with USB 3 speeds.',
                'images' => [
                    'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'A17 Pro Chip (6-Core CPU, 6-Core GPU)',
                    'Display' => '6.7" Super Retina XDR OLED (ProMotion 120Hz Always-On)',
                    'Camera' => '48MP Main + 12MP Ultra Wide + 12MP 5x Telephoto',
                    'Connector' => 'USB-C with USB 3 (up to 10Gbps transfer speed)',
                    'Build' => 'Grade 5 Titanium Design with Ceramic Shield Front'
                ],
                'reviews' => [
                    ['user_name' => 'Rishi Agarwal', 'rating' => 5, 'comment' => 'Titanium build makes it noticeably lighter in hand. 5x optical zoom camera is razor sharp.']
                ],
                'faqs' => [
                    ['question' => 'Does it support Log video recording?', 'answer' => 'Yes, supports Apple Log and Academy Color Encoding System (ACES) recording to external SSDs.']
                ]
            ],
            // 20
            [
                'name' => 'Samsung Galaxy S24 Ultra 5G (12GB RAM, 512GB) - Titanium Gray',
                'price' => 139999.00,
                'old_price' => 144999.00,
                'stock' => 28,
                'description' => 'Welcome to the era of mobile AI with Galaxy AI. Capture stunning photos with 200MP Quad Telephoto camera, flat 6.8" 120Hz AMOLED screen, Titanium frame, and embedded S Pen.',
                'images' => [
                    'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1580910051074-3eb694886505?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'Snapdragon 8 Gen 3 for Galaxy',
                    'AI Features' => 'Circle to Search, Live Translate, Note Assist, Photo Assist',
                    'Camera' => '200MP Main + 50MP 5x Telephoto + 10MP 3x + 12MP Ultra-Wide',
                    'Glass' => 'Corning Gorilla Armor (75% reflection reduction)',
                    'Battery' => '5000 mAh with 45W Fast Charging'
                ],
                'reviews' => [
                    ['user_name' => 'Simran Kaur', 'rating' => 5, 'comment' => 'Galaxy AI Circle to Search is useful every single day. Screen antireflective coating is amazing.']
                ],
                'faqs' => [
                    ['question' => 'How many years of OS updates are promised?', 'answer' => 'Samsung guarantees 7 generations of OS upgrades and 7 years of security updates.']
                ]
            ],
            // 21
            [
                'name' => 'Google Pixel 8 Pro (12GB RAM, 128GB) - Bay Blue',
                'price' => 106999.00,
                'old_price' => 112999.00,
                'stock' => 16,
                'description' => 'Engineered by Google, the Pixel 8 Pro features the Tensor G3 chip, AI-driven photography, Super Actua display, Temperature sensor, and Best Take photo editor.',
                'images' => [
                    'https://images.unsplash.com/photo-1598327105666-5b89351aff97?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'Google Tensor G3 & Titan M2 Security Coprocessor',
                    'Display' => '6.7" Super Actua OLED (1-120Hz, 2400 nits peak brightness)',
                    'Camera' => '50MP Main + 48MP Ultra-Wide + 48MP 5x Telephoto',
                    'Special Tech' => 'Object Temperature Sensor & Audio Magic Eraser',
                    'OS' => 'Pure Android with 7 Years OS & Feature Drops'
                ],
                'reviews' => [
                    ['user_name' => 'Ketan Verma', 'rating' => 5, 'comment' => 'Skin tones in photos look true-to-life. Magic Editor software features feel futuristic.']
                ],
                'faqs' => [
                    ['question' => 'Does it feature Face Unlock and Fingerprint?', 'answer' => 'Yes, supports Class 3 biometric Face Unlock (for payments) and under-display Fingerprint.']
                ]
            ],
            // 22
            [
                'name' => 'OnePlus 12 5G (16GB RAM, 512GB) - Silky Black',
                'price' => 69999.00,
                'old_price' => 74999.00,
                'stock' => 30,
                'description' => 'Smooth Beyond Belief. Powered by Snapdragon 8 Gen 3, 4th Gen Hasselblad Camera System for Mobile, 2K 120Hz ProXDR display, 100W SUPERVOOC and 50W AIRVOOC charging.',
                'images' => [
                    'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Processor' => 'Snapdragon 8 Gen 3 with Dual Cryo-velocity VC Cooling',
                    'Charging' => '100W Wired (1-100% in 26 mins) & 50W Wireless',
                    'Camera' => '50MP Sony LYT-808 + 64MP 3x Periscope Telephoto + 48MP UW',
                    'Battery' => '5400 mAh Dual-Cell Battery',
                    'Display' => '6.82" 2K 120Hz ProXDR AMOLED (4500 nits peak)'
                ],
                'reviews' => [
                    ['user_name' => 'Pranav Rao', 'rating' => 5, 'comment' => '100W charging is ridiculously fast! 0 to 100 in less than 30 minutes while getting ready.']
                ],
                'faqs' => [
                    ['question' => 'Is the 100W charger included in the box?', 'answer' => 'Yes, 100W SUPERVOOC power adapter and Signature Red Cable are included.']
                ]
            ],
            // 23
            [
                'name' => 'Apple Watch Ultra 2 GPS + Cellular 49mm Titanium Case',
                'price' => 89900.00,
                'old_price' => 94900.00,
                'stock' => 15,
                'description' => 'The ultimate sports and adventure watch. Powered by S9 SiP enabling double tap gesture, 3000 nits display, Dual-frequency GPS, and up to 72 hours battery in Low Power Mode.',
                'images' => [
                    'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1434493789847-2f02dc6ca35d?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Case' => '49mm Aerospace-Grade Titanium Case with Sapphire Crystal',
                    'Chip' => 'S9 SiP with 4-Core Neural Engine',
                    'Display' => '3000 nits Always-On Retina Display',
                    'GPS' => 'Precision Dual-Frequency GPS (L1 and L5)',
                    'Water Resistance' => '100m Water Resistant & EN13319 Scuba Certified'
                ],
                'reviews' => [
                    ['user_name' => 'Capt. Vikram Singh', 'rating' => 5, 'comment' => 'Double tap gesture with index finger and thumb is so convenient while running!']
                ],
                'faqs' => [
                    ['question' => 'Is it suitable for recreational scuba diving?', 'answer' => 'Yes, it works as a wrist dive computer down to 40 meters with the Oceanic+ app.']
                ]
            ],
            // 24
            [
                'name' => 'Samsung Galaxy Watch6 Classic 47mm Bluetooth (Black)',
                'price' => 36999.00,
                'old_price' => 40999.00,
                'stock' => 22,
                'description' => 'Return of the iconic rotating bezel. Track your health, sleep coach insights, ECG, Blood Pressure, and personalized HR zones on a 30% larger Sapphire Crystal display.',
                'images' => [
                    'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Bezel' => 'Physical Rotating Stainless Steel Bezel',
                    'Display' => '1.5" Super AMOLED (480 x 480) Sapphire Crystal',
                    'Sensors' => 'BioActive Sensor (ECG, BIA, HR), Temperature Sensor',
                    'Durability' => '5ATM + IP68 / MIL-STD-810H',
                    'OS' => 'Wear OS Powered by Samsung (Google Wallet & Maps)'
                ],
                'reviews' => [
                    ['user_name' => 'Manish Pandey', 'rating' => 5, 'comment' => 'Physical rotating bezel is satisfying to use. Sleep coaching insights helped fix my schedule.']
                ],
                'faqs' => [
                    ['question' => 'Does it support Google Pay and WhatsApp?', 'answer' => 'Yes, native Google Wallet contactless payments and WhatsApp watch app are supported.']
                ]
            ],
            // 25
            [
                'name' => 'Garmin Fenix 7X Pro Solar Outdoor Multisport GPS Watch',
                'price' => 98990.00,
                'old_price' => 104990.00,
                'stock' => 9,
                'description' => 'Conquer every hour with advanced training features, 24/7 health tracking, LED flashlight, and Power Sapphire solar charging lens for up to 37 days battery life.',
                'images' => [
                    'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Lens' => 'Power Sapphire Solar Charging Lens',
                    'Flashlight' => 'Built-In Multi-LED Flashlight with Strobe Mode',
                    'Battery Life' => 'Up to 37 Days in Smartwatch mode with Solar',
                    'Maps' => 'Preloaded TopoActive & Skiview Maps',
                    'Sensors' => 'Elevate Gen 5 HR Sensor & Pulse Ox'
                ],
                'reviews' => [
                    ['user_name' => 'Aditya Ranade', 'rating' => 5, 'comment' => 'The built-in LED flashlight on my wrist is a lifesaver during night trail runs!']
                ],
                'faqs' => [
                    ['question' => 'Is the screen visible under direct sunlight?', 'answer' => 'Yes, transflective Memory-in-Pixel (MIP) display is crystal clear in bright sunlight.']
                ]
            ],
            // 26
            [
                'name' => 'Canon EOS R6 Mark II Full-Frame Mirrorless Camera (Body Only)',
                'price' => 215995.00,
                'old_price' => 229995.00,
                'stock' => 11,
                'description' => 'Master both stills and motion. 24.2 megapixel full-frame CMOS sensor, 40 fps electronic burst shooting, Dual Pixel CMOS AF II with AI deep learning subject tracking, and 6K oversampled 4K 60p.',
                'images' => [
                    'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Sensor' => '24.2MP Full-Frame CMOS Sensor',
                    'Autofocus' => 'Dual Pixel CMOS AF II (Vehicles, Animals, People)',
                    'Continuous Shooting' => 'Up to 40 fps Electronic / 12 fps Mechanical',
                    'Video' => '4K 60p 10-Bit 4:2:2 (Oversampled from 6K) & Canon Log 3',
                    'Stabilization' => 'In-Body Image Stabilizer (Up to 8 stops IBIS)'
                ],
                'reviews' => [
                    ['user_name' => 'Saurabh Sen', 'rating' => 5, 'comment' => 'Autofocus tracking sticks to eyes like glue even when subject is moving rapidly!']
                ],
                'faqs' => [
                    ['question' => 'Does it feature dual SD card slots?', 'answer' => 'Yes, features dual UHS-II SD card slots for instant backup recording.']
                ]
            ],
            // 27
            [
                'name' => 'Sony Alpha 7 IV Full-Frame Hybrid Camera (Body Only)',
                'price' => 209990.00,
                'old_price' => 222990.00,
                'stock' => 14,
                'description' => 'An ideal hybrid camera. 33 megapixel Exmor R back-illuminated sensor, BIONZ XR processing engine, 4K 60p 10-bit video, and 759-point focal-plane phase-detection AF.',
                'images' => [
                    'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Sensor' => '33MP Full-Frame Exmor R CMOS Sensor',
                    'Processor' => 'BIONZ XR Image Processing Engine',
                    'Video' => '4K 60p 10-bit 4:2:2, S-Cinetone & S-Log3',
                    'EVF' => '3.68M-dot Quad-VGA OLED Viewfinder',
                    'Stabilization' => '5-Axis Optical In-body Image Stabilization (5.5 stops)'
                ],
                'reviews' => [
                    ['user_name' => 'Nikhil Wagle', 'rating' => 5, 'comment' => '33 megapixels is the sweet spot for cropping while keeping file sizes manageable.']
                ],
                'faqs' => [
                    ['question' => 'Can I use it as a high quality webcam for livestreaming?', 'answer' => 'Yes, supports 4K 15p / 1080p 60p UVC/UAC USB streaming plug-and-play.']
                ]
            ],
            // 28
            [
                'name' => 'DJI Mini 4 Pro Drone with RC 2 Smart Controller',
                'price' => 112000.00,
                'old_price' => 125000.00,
                'stock' => 15,
                'description' => 'Under 249g mini drone with omnidirectional obstacle sensing, 4K 60fps HDR video, True Vertical Shooting for social media, and up to 34 minutes flight time.',
                'images' => [
                    'https://images.unsplash.com/photo-1527977966376-1c8408f9f108?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1508614589041-895b88991e3e?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Weight' => '< 249 grams Ultra-Light & Foldable',
                    'Obstacle Sensing' => 'Omnidirectional Active Obstacle Avoidance',
                    'Video' => '4K/60fps HDR & 4K/100fps Slow Motion (10-bit D-Log M)',
                    'Transmission' => 'DJI O4 HD Video Transmission (20 km range)',
                    'Flight Time' => '34 Minutes max battery flight time'
                ],
                'reviews' => [
                    ['user_name' => 'Kabir Deshmukh', 'rating' => 5, 'comment' => 'Omnidirectional sensors make flying so stress-free even around trees. RC 2 controller screen is crisp.']
                ],
                'faqs' => [
                    ['question' => 'Does the RC 2 controller require a smartphone?', 'answer' => 'No, DJI RC 2 has a built-in 5.5-inch FHD bright screen and pre-installed DJI Fly app.']
                ]
            ],
            // 29
            [
                'name' => 'GoPro HERO12 Black Action Camera',
                'price' => 37990.00,
                'old_price' => 45000.00,
                'stock' => 25,
                'description' => 'Incredible image quality with 5.3K video, HyperSmooth 6.0 video stabilization, HDR for photos and videos, Bluetooth audio support for AirPods, and rugged waterproof build to 33ft.',
                'images' => [
                    'https://images.unsplash.com/photo-1564466809058-bf4114d55352?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1527977966376-1c8408f9f108?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Resolution' => '5.3K 60fps & 4K 120fps Video',
                    'Stabilization' => 'Emmy Award-Winning HyperSmooth 6.0 with AutoBoost',
                    'Audio' => 'Bluetooth Audio Connectivity (AirPods & Wireless Mics)',
                    'Waterproof' => 'Waterproof down to 33ft (10m) without housing',
                    'Photos' => '27MP Photos & 24.7MP Frame Grabs'
                ],
                'reviews' => [
                    ['user_name' => 'Deepika S.', 'rating' => 5, 'comment' => 'HyperSmooth stabilization makes biking videos look like they were filmed on a motorized gimbal!']
                ],
                'faqs' => [
                    ['question' => 'Does it support vertical shooting for Shorts/Reels?', 'answer' => 'Yes, 8:7 aspect ratio lets you crop for 9:16 vertical or 16:9 widescreen without losing resolution.']
                ]
            ],
            // 30
            [
                'name' => 'Dyson V15 Detect Cordless Vacuum Cleaner',
                'price' => 62900.00,
                'old_price' => 65900.00,
                'stock' => 12,
                'description' => 'Dyson’s most powerful intelligent cordless vacuum. Illumination reveals invisible dust on hard floors. Piezo sensor counts and sizes particles, displaying proof on LCD screen.',
                'images' => [
                    'https://images.unsplash.com/photo-1558317374-067fb5f30001?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Suction Power' => '230 AW Suction Power',
                    'Feature' => 'Laser Dust Illumination & Piezo Acoustic Particle Sensor',
                    'Runtime' => 'Up to 60 Minutes fade-free floor cleaning',
                    'Filtration' => 'Fully Sealed HEPA Filtration (traps 99.99% of 0.1 micron particles)',
                    'Bin Volume' => '0.77 Liters'
                ],
                'reviews' => [
                    ['user_name' => 'Ritu Nambiar', 'rating' => 5, 'comment' => 'The green laser reveals dust specs you never knew existed on wood floors. Amazing suction!']
                ],
                'faqs' => [
                    ['question' => 'Does the hair screw tool tangle with long pet hair?', 'answer' => 'No, anti-tangle conical brush bar spirals hair straight into the bin cleanly.']
                ]
            ],
            // 31
            [
                'name' => 'Herman Miller Embody Gaming Chair (Cyan / Black)',
                'price' => 165000.00,
                'old_price' => 175000.00,
                'stock' => 5,
                'description' => 'Designed in partnership with Logitech G. Fully ergonomic backfit adjustment, pixelated support system that distributes weight evenly, and copper-infused cooling foam cushion.',
                'images' => [
                    'https://images.unsplash.com/photo-1580481072645-022f9a6d8310?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1505797149-43b0069ec26b?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Ergonomics' => 'Backfit Adjustment & Pixelated Matrix Support',
                    'Cushion' => 'Copper-Infused Cooling Foam Layer',
                    'Warranty' => '12-Year Official Herman Miller Warranty (24/7 use)',
                    'Weight Capacity' => 'Tested up to 136 kg (300 lbs)',
                    'Adjustments' => 'Seat Depth, Armrest Height/Width, Tilt Limiter'
                ],
                'reviews' => [
                    ['user_name' => 'Devendra Patel', 'rating' => 5, 'comment' => 'Completely cured my lower back pain after 10-hour coding sessions. Best investment ever.']
                ],
                'faqs' => [
                    ['question' => 'Does it come fully assembled?', 'answer' => 'Yes, Herman Miller chairs ship 100% fully assembled in a heavy duty protective box.']
                ]
            ],
            // 32
            [
                'name' => 'Philips Hue White & Color Ambiance Smart Bulb Starter Kit',
                'price' => 15999.00,
                'old_price' => 17999.00,
                'stock' => 40,
                'description' => 'Transform your home lighting with 16 million colors and shades of white. Starter kit includes 3 smart color E27 bulbs, Hue Bridge hub, and Smart Dimmer Switch.',
                'images' => [
                    'https://images.unsplash.com/photo-1550985616-10810253b84d?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1507499739999-097706ad8914?auto=format&fit=crop&w=800&q=80'
                ],
                'specs' => [
                    'Colors' => '16 Million Colors & Tunable Warm to Cool White',
                    'Lumen Output' => '1100 Lumens per bulb (75W equivalent)',
                    'Includes' => '3x E27 Smart Bulbs, 1x Hue Bridge, 1x Wireless Dimmer Switch',
                    'Ecosystem' => 'Apple HomeKit, Alexa, Google Assistant, Matter',
                    'Lifespan' => '25,000 Hours'
                ],
                'reviews' => [
                    ['user_name' => 'Harsh Vardhan', 'rating' => 5, 'comment' => 'Syncing room lights with movies on TV creates an immersive home theater vibe.']
                ],
                'faqs' => [
                    ['question' => 'Does it require the Hue Bridge hub to operate?', 'answer' => 'The included Hue Bridge unlocks out-of-home control, automations, and light syncing.']
                ]
            ]
        ];

        foreach ($productsData as $data) {
            $product = Product::create([
                'seller_id' => 1,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'],
                'price' => $data['price'],
                'old_price' => $data['old_price'],
                'stock' => $data['stock'],
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'category_id' => rand(1, 5),
                'status' => 1,
                'featured' => rand(0, 1),
            ]);

            // Add Images
            foreach ($data['images'] as $idx => $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $img,
                    'is_primary' => ($idx === 0) ? 1 : 0,
                ]);
            }

            // Add Specs
            foreach ($data['specs'] as $key => $val) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'spec_key' => $key,
                    'spec_value' => $val,
                ]);
            }

            // Add Reviews
            foreach ($data['reviews'] as $rev) {
                ProductReview::create([
                    'product_id' => $product->id,
                    'user_name' => $rev['user_name'],
                    'rating' => $rev['rating'],
                    'comment' => $rev['comment'],
                ]);
            }

            // Add FAQs
            foreach ($data['faqs'] as $faq) {
                ProductFaq::create([
                    'product_id' => $product->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]);
            }
        }
    }
}
