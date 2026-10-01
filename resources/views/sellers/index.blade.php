<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $currentSeller['name'] }} — UnCart Seller Central</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: #f8fafc;
            color: #0f172a;
            overflow-x: hidden;
            width: 100%;
        }

        /* -------------------------------------------------------------
           DYNAMIC ISLAND NAVBAR
        ------------------------------------------------------------- */
        .nav-container {
            position: fixed;
            top: 18px;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            padding: 0 16px;
            pointer-events: none;
        }

        .navbar {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            color: #0f172a;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12),
                0 0 0 1px rgba(15, 23, 42, 0.08);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            width: 880px;
            padding: 8px 18px;
        }

        .nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 42px;
            cursor: pointer;
            user-select: none;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-icon {
            width: 32px;
            height: 32px;
            background: #16a34a;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25);
        }

        .brand-icon svg {
            width: 18px;
            height: 18px;
            fill: #ffffff;
        }

        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .seller-tag {
            background: #16a34a;
            color: #ffffff;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-link {
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #16a34a;
        }

        .btn-add-product {
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 0.82rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .btn-add-product:hover {
            transform: scale(1.04);
            background: #16a34a;
        }

        .expand-toggle {
            background: #f1f5f9;
            border: none;
            color: #0f172a;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.4s ease;
        }

        .expand-toggle:hover {
            background: #e2e8f0;
        }

        .navbar.expanded {
            width: 880px;
            border-radius: 28px;
            padding-bottom: 16px;
        }

        .navbar.expanded .expand-toggle {
            transform: rotate(180deg);
        }

        .nav-expanded-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
        }

        .navbar.expanded .nav-expanded-content {
            max-height: 500px;
            opacity: 1;
            padding-top: 16px;
        }

        .drawer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .drawer-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 12px;
        }

        /* -------------------------------------------------------------
           PAGE CONTENT & SELLER SWITCHER
        ------------------------------------------------------------- */
        .page-wrapper {
            width: 100%;
            max-width: 1760px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        .seller-header-banner {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #ffffff;
            border-radius: 32px;
            padding: 36px 40px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            position: relative;
            overflow: hidden;
        }

        .seller-header-banner::after {
            content: '';
            position: absolute;
            right: -60px;
            bottom: -60px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.25) 0%, rgba(22, 163, 74, 0) 70%);
            border-radius: 50%;
        }

        .seller-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .seller-subtitle {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-top: 6px;
        }

        .seller-switcher-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 10px 16px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            z-index: 2;
        }

        .seller-select {
            background: #ffffff;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            padding: 10px 16px;
            border-radius: 14px;
            font-size: 0.88rem;
            font-weight: 700;
            outline: none;
            cursor: pointer;
        }

        /* KPI Analytics Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 36px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px rgba(15, 23, 42, 0.06);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .stat-icon-wrapper {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .icon-revenue {
            background: #dcfce7;
            color: #16a34a;
        }

        .icon-products {
            background: #eff6ff;
            color: #2563eb;
        }

        .icon-active {
            background: #fefce8;
            color: #ca8a04;
        }

        .icon-rating {
            background: #f3e8ff;
            color: #9333ea;
        }

        .stat-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
        }

        .stat-badge {
            font-size: 0.75rem;
            font-weight: 700;
            color: #16a34a;
            margin-top: 4px;
            display: inline-block;
        }

        /* Inventory Table Card */
        .bento-table-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 32px;
            padding: 32px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.03);
            margin-bottom: 40px;
            overflow-x: auto;
        }

        .table-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .table-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
        }

        .aura-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .aura-table th {
            padding: 14px 12px;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            border-bottom: 1.5px solid #f1f5f9;
            letter-spacing: 0.5px;
        }

        .aura-table td {
            padding: 16px 12px;
            color: #0f172a;
            font-size: 0.88rem;
            font-weight: 600;
            border-bottom: 1px solid #f8fafc;
            vertical-align: middle;
        }

        .product-thumb-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            flex-shrink: 0;
        }

        .product-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-status.active {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-status.inactive {
            background: #fef2f2;
            color: #ef4444;
        }

        .action-circle-btn {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #0f172a;
            padding: 8px 14px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .action-circle-btn:hover {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        /* Seller Toolkit Grid */
        .toolkit-section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
        }

        .toolkit-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .toolkit-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .toolkit-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        .toolkit-card h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .toolkit-card p {
            font-size: 0.85rem;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 18px;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .toolkit-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-wrapper {
                padding: 24px 16px 100px !important;
            }

            .seller-header-banner {
                padding: 24px;
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- DYNAMIC ISLAND NAVBAR -->
    <div class="nav-container">
        <nav class="navbar" id="dynamicNavbar">
            <div class="nav-header">
                <a href="{{ route('user.index') }}" class="nav-left">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                    <span class="seller-tag">SELLER #{{ $currentSeller['id'] }}</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('seller.index', ['seller_id' => $currentSeller['id']]) }}" class="nav-link active">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link">Inventory</a>
                    <a href="{{ route('user.index') }}" class="nav-link">Storefront</a>
                    <a href="{{ route('admin.index') }}" class="nav-link">Admin Portal</a>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <a href="{{ route('admin.products.index') }}" class="btn-add-product">
                        + Add My Product
                    </a>
                    <button class="expand-toggle" aria-label="Toggle Navigation" onclick="toggleNav();">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Expanded Drawer -->
            <div class="nav-expanded-content">
                <div class="drawer-grid" style="padding-top: 14px;">
                    <div class="drawer-section">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; text-transform: uppercase;">SELLER QUICK NAVIGATION</div>
                        <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 10px;">
                            <a href="{{ route('seller.index', ['seller_id' => $currentSeller['id']]) }}" style="color: #16a34a; text-decoration: none; font-weight: 700;">📊 Seller Analytics Dashboard</a>
                            <a href="{{ route('admin.products.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">📦 Product Inventory Manager</a>
                        </div>
                    </div>
                    <div class="drawer-section">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; text-transform: uppercase;">STORE NAVIGATION</div>
                        <div style="margin-top: 10px;">
                            <a href="{{ route('user.index') }}" style="color: #0f172a; text-decoration: none; font-weight: 700;">🌐 UnCart Main Marketplace</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- MAIN PAGE CONTENT -->
    <main class="page-wrapper">

        <!-- Seller Header Banner with Multi-Seller Switcher -->
        <div class="seller-header-banner">
            <div>
                <span style="background: rgba(22, 163, 74, 0.2); color: #4ade80; font-size: 0.75rem; font-weight: 800; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; margin-bottom: 8px;">
                    {{ $currentSeller['badge'] }}
                </span>
                <h1 class="seller-title">{{ $currentSeller['name'] }}</h1>
                <p class="seller-subtitle">Store Code: <strong>{{ $currentSeller['store_code'] }}</strong> | Isolated Seller Dashboard & Isolated Inventory</p>
            </div>

            <!-- Seller Account Switcher -->
            <div class="seller-switcher-box">
                <span style="font-size: 0.82rem; font-weight: 700; color: #cbd5e1;">Switch Account:</span>
                <select class="seller-select" onchange="window.location.href='?seller_id=' + this.value">
                    @foreach($sellersList as $sId => $sMeta)
                        <option value="{{ $sId }}" {{ $currentSeller['id'] == $sId ? 'selected' : '' }}>
                            Seller #{{ $sId }}: {{ $sMeta['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- KPI Analytics Stats Grid (Isolated to Active Seller) -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">My Catalog Value</span>
                    <div class="stat-icon-wrapper icon-revenue">₹</div>
                </div>
                <div class="stat-value">₹{{ number_format($stats['total_revenue'] ?? 0) }}</div>
                <span class="stat-badge">↑ Seller #{{ $currentSeller['id'] }} Live Inventory Value</span>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">My Products</span>
                    <div class="stat-icon-wrapper icon-products">📦</div>
                </div>
                <div class="stat-value">{{ $stats['total_products'] ?? 0 }}</div>
                <span class="stat-badge">Owned by {{ $currentSeller['name'] }}</span>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Active Listings</span>
                    <div class="stat-icon-wrapper icon-active">⚡</div>
                </div>
                <div class="stat-value">{{ $stats['active_listings'] ?? 0 }}</div>
                <span class="stat-badge">Visible to Customers</span>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Seller Rating</span>
                    <div class="stat-icon-wrapper icon-rating">★</div>
                </div>
                <div class="stat-value">4.95 / 5</div>
                <span class="stat-badge">Verified Partner</span>
            </div>
        </div>

        <!-- Seller Inventory Products Table (Isolated to Active Seller) -->
        <div class="bento-table-card">
            <div class="table-header-flex">
                <div>
                    <h2 class="table-title">Products Owned by {{ $currentSeller['name'] }}</h2>
                    <p style="color: #64748b; font-size: 0.85rem; margin-top: 2px;">Only products belonging to seller #{{ $currentSeller['id'] }} are displayed here.</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="action-circle-btn" style="padding: 10px 18px;">
                    + Add New Product to My Store →
                </a>
            </div>

            <table class="aura-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Name & Slug</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price (INR)</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        @php
                            $imgObj = $product->primaryImage ?? ($product->images ? $product->images->first() : null);
                            $imgPath = $imgObj ? $imgObj->image : null;
                            $imgSrc = $imgPath ? (Str::startsWith($imgPath, ['http://', 'https://']) ? $imgPath : asset($imgPath)) : 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                            $catMap = [
                                1 => 'Audio',
                                2 => 'Gaming',
                                3 => 'Furniture',
                                4 => 'Tech',
                            ];
                            $categoryName = $catMap[$product->category_id] ?? 'Tech';
                        @endphp
                        <tr>
                            <td><strong>#{{ $product->id }}</strong></td>
                            <td>
                                <div class="product-thumb-wrapper">
                                    <img src="{{ $imgSrc }}" class="product-thumb" alt="{{ $product->name }}" onerror="this.src='https://via.placeholder.com/48';">
                                </div>
                            </td>
                            <td>
                                <div><strong>{{ $product->name }}</strong></div>
                                <div style="font-size: 0.75rem; color: #64748b;">{{ $product->slug }}</div>
                            </td>
                            <td><span style="font-family: monospace; background: #f1f5f9; padding: 2px 6px; border-radius: 6px; font-size: 0.8rem;">{{ $product->sku }}</span></td>
                            <td>{{ $categoryName }}</td>
                            <td>
                                <strong style="color: #0f172a;">₹{{ number_format($product->price) }}</strong>
                                @if($product->old_price)
                                    <span style="font-size: 0.78rem; color: #94a3b8; text-decoration: line-through; margin-left: 4px;">₹{{ number_format($product->old_price) }}</span>
                                @endif
                            </td>
                            <td>
                                <span style="color: {{ $product->stock > 5 ? '#16a34a' : '#d97706' }}; font-weight: 700;">
                                    {{ $product->stock }} in stock
                                </span>
                            </td>
                            <td>
                                @if($product->status)
                                    <span class="badge-status active">● Active</span>
                                @else
                                    <span class="badge-status inactive">● Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.products.index') }}" class="action-circle-btn">Edit Listing</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 40px; color: #64748b;">
                                📦 No products owned by {{ $currentSeller['name'] }}. Click <strong>+ Add New Product to My Store</strong> above to list one!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Seller Tools Grid -->
        <h2 class="toolkit-section-title">Seller Partner Tools</h2>
        <div class="toolkit-grid">
            <div class="toolkit-card">
                <div>
                    <div class="toolkit-icon">🚀</div>
                    <h3>Fast Fulfillment</h3>
                    <p>Schedule same-day shipping pick up for {{ $currentSeller['name'] }} orders.</p>
                </div>
                <a href="#" class="action-circle-btn">Configure Shipping</a>
            </div>

            <div class="toolkit-card">
                <div>
                    <div class="toolkit-icon">💳</div>
                    <h3>Weekly Settlements</h3>
                    <p>Automated direct bank payouts for {{ $currentSeller['name'] }} processed every Monday.</p>
                </div>
                <a href="#" class="action-circle-btn">Payout Settings</a>
            </div>

            <div class="toolkit-card">
                <div>
                    <div class="toolkit-icon">📈</div>
                    <h3>Store Conversion Analytics</h3>
                    <p>Access conversion metrics and customer reviews for Seller #{{ $currentSeller['id'] }}.</p>
                </div>
                <a href="#" class="action-circle-btn">View Reports</a>
            </div>
        </div>

    </main>

    <script>
        function toggleNav() {
            document.getElementById('dynamicNavbar').classList.toggle('expanded');
        }

        document.addEventListener('click', function (e) {
            const navbar = document.getElementById('dynamicNavbar');
            if (navbar && !navbar.contains(e.target) && navbar.classList.contains('expanded')) {
                navbar.classList.remove('expanded');
            }
        });
    </script>
</body>

</html>
