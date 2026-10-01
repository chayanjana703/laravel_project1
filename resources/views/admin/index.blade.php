<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnCart Admin — Command Center</title>
    <!-- Google Fonts & Chart.js -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: #f1f5f9;
            color: #0f172a;
            overflow-x: hidden;
            width: 100%;
        }

        /* -------------------------------------------------------------
           DYNAMIC ISLAND NAVBAR (EXACT REPLICA FROM STOREFRONT INDEX)
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

        /* Keyframe Entrance for Dynamic Island Navbar */
        @keyframes navSlideDown {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .navbar {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            color: #0f172a;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08),
                        0 0 0 1px rgba(15, 23, 42, 0.06);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            width: 780px;
            padding: 8px 16px;
            animation: navSlideDown 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .navbar:hover {
            box-shadow: 0 25px 50px rgba(37, 99, 235, 0.12),
                        0 0 0 1px rgba(37, 99, 235, 0.15);
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
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .nav-left:hover {
            transform: translateX(2px);
        }

        .brand-icon {
            width: 32px;
            height: 32px;
            background: #0f172a;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
            transition: all 0.3s ease;
        }

        .nav-left:hover .brand-icon {
            background: #2563eb;
            transform: rotate(-6deg) scale(1.08);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }

        .brand-icon svg {
            width: 18px;
            height: 18px;
            fill: #ffffff;
            transition: transform 0.3s ease;
        }

        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .admin-tag {
            background: #0f172a;
            color: #ffffff;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background 0.25s ease;
        }

        .nav-left:hover .admin-tag {
            background: #2563eb;
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
            position: relative;
            padding: 4px 2px;
            transition: color 0.25s ease, transform 0.2s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            border-radius: 4px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: #2563eb;
            transform: translateY(-1px);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .nav-link.active {
            color: #2563eb;
            font-weight: 700;
        }

        /* Profile & Cart Buttons */
        .profile-dropdown-wrapper {
            position: relative;
            display: inline-block;
        }

        .profile-icon-btn {
            background: #f1f5f9;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .profile-dropdown-wrapper:hover .profile-icon-btn, .profile-icon-btn:hover {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
        }

        .profile-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 220px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 12px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(15, 23, 42, 0.04);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1001;
        }

        .profile-dropdown-wrapper:hover .profile-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-menu-header {
            padding: 6px 8px 10px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 8px;
        }

        .profile-menu-header .user-name { font-weight: 700; font-size: 0.9rem; color: #0f172a; }
        .profile-menu-header .user-desc { font-size: 0.75rem; color: #64748b; }

        .profile-menu-link {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 10px; color: #475569; font-size: 0.82rem; font-weight: 600;
            text-decoration: none; border-radius: 10px; transition: all 0.15s ease;
        }

        .profile-menu-link:hover { background: #f8fafc; color: #0f172a; }

        .cart-btn {
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 20px;
            padding: 7px 14px;
            font-size: 0.82rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .cart-btn:hover { transform: scale(1.04); background: #1e293b; }

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

        .expand-toggle:hover { background: #e2e8f0; }

        .navbar.expanded {
            width: 800px;
            border-radius: 28px;
            padding-bottom: 16px;
        }

        .navbar.expanded .expand-toggle { transform: rotate(180deg); }

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
            grid-template-columns: 1.1fr 1fr;
            gap: 14px;
        }

        .drawer-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 12px;
        }

        /* -------------------------------------------------------------
           MAIN PAGE WRAPPER & BENTO CARDS (EXACT REPLICA FROM STORE FRONT)
        ------------------------------------------------------------- */
        .page-wrapper {
            width: 100%;
            max-width: 1760px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        /* Bento Grid */
        .bento-grid {
            display: grid;
            grid-template-columns: 400px 1.2fr 300px;
            gap: 24px;
            margin-bottom: 48px;
        }

        /* KPI Cards in Bento Style */
        /* -------------------------------------------------------------
           LIGHT & COLOR EFFECTS + SCROLL REVEAL ANIMATIONS
        ------------------------------------------------------------- */
        body {
            background: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.07) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(16, 185, 129, 0.07) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(99, 102, 241, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
        }

        /* Scroll Reveal Utility Classes */
        .reveal {
            opacity: 0;
            transform: translateY(30px) scale(0.98);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }

        /* Glowing Light Effects for KPI Cards */
        .card-kpi {
            position: relative;
            background: #ffffff !important;
            border-radius: 20px !important;
            padding: 22px 24px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03) !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-kpi::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 4px;
            background: #2563eb;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card-kpi:hover {
            transform: translateY(-4px) !important;
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08) !important;
            border-color: #cbd5e1 !important;
        }

        .card-kpi:hover::before {
            opacity: 1;
        }

        /* Light Card Accent Styles */
        .card-kpi.accent-blue::before { background: linear-gradient(180deg, #2563eb, #3b82f6); }
        .card-kpi.accent-green::before { background: linear-gradient(180deg, #10b981, #059669); }
        .card-kpi.accent-amber::before { background: linear-gradient(180deg, #f59e0b, #d97706); }
        .card-kpi.accent-purple::before { background: linear-gradient(180deg, #8b5cf6, #6d28d9); }

        .kpi-head { display: flex; justify-content: space-between; align-items: center; }
        .kpi-title-box { display: flex; align-items: center; gap: 10px; }
        .kpi-icon-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 700;
        }
        .kpi-icon-avatar.blue { background: #eff6ff; color: #2563eb; }
        .kpi-icon-avatar.green { background: #ecfdf5; color: #10b981; }
        .kpi-icon-avatar.amber { background: #fffbeb; color: #f59e0b; }
        .kpi-icon-avatar.purple { background: #f5f3ff; color: #8b5cf6; }

        .kpi-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.88rem; font-weight: 700; color: #475569; }
        .kpi-badge { font-size: 0.68rem; font-weight: 800; padding: 4px 10px; border-radius: 12px; text-transform: uppercase; letter-spacing: 0.5px; }

        .kpi-value { font-family: 'Space Grotesk', sans-serif; font-size: 2.1rem; font-weight: 700; color: #0f172a; margin: 14px 0 6px; letter-spacing: -0.5px; }
        .kpi-sub { font-size: 0.8rem; font-weight: 600; display: flex; align-items: center; gap: 4px; }

        .kpi-head { display: flex; justify-content: space-between; align-items: center; }
        .kpi-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; }
        .kpi-badge { background: #0f172a; color: #ffffff; font-size: 0.68rem; font-weight: 800; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; }

        .kpi-value { font-family: 'Space Grotesk', sans-serif; font-size: 2.4rem; font-weight: 700; color: #0f172a; margin: 16px 0 8px; }
        .kpi-sub { font-size: 0.85rem; color: #16a34a; font-weight: 700; display: flex; align-items: center; gap: 4px; }

        /* Bottom Section Grid */
        .catalog-section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 24px;
        }

        .bento-table-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 32px;
            padding: 32px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.03);
            margin-bottom: 32px;
        }

        .aura-table { width: 100%; border-collapse: collapse; text-align: left; }
        .aura-table th { padding: 14px; color: #64748b; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; border-bottom: 1.5px solid #f1f5f9; letter-spacing: 0.5px; }
        .aura-table td { padding: 16px 14px; color: #0f172a; font-size: 0.9rem; font-weight: 600; border-bottom: 1px solid #f8fafc; vertical-align: middle; }

        .table-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
        .table-badge.success { background: #f0fdf4; color: #16a34a; }
        .table-badge.pending { background: #fffbeb; color: #d97706; }

        .action-circle-btn {
            background: #f1f5f9; border: 1px solid #e2e8f0; color: #0f172a;
            padding: 8px 16px; border-radius: 14px; font-size: 0.82rem; font-weight: 700;
            cursor: pointer; transition: all 0.2s ease; text-decoration: none;
        }
        .action-circle-btn:hover { background: #0f172a; color: #ffffff; border-color: #0f172a; }

        @media (max-width: 1200px) {
            .bento-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 900px) {
            .nav-container { top: auto !important; bottom: 16px !important; padding: 0 12px; }
            .navbar { width: 100% !important; border-radius: 28px; }
            .nav-links { display: none; }
            .page-wrapper { padding: 24px 16px 120px !important; }
            .bento-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- DYNAMIC ISLAND NAVBAR (EXACT MATCH TO INDEX) -->
    <div class="nav-container">
        <nav class="navbar" id="dynamicNavbar">
            <div class="nav-header">
                <a href="../index.blade.php" class="nav-left">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                    <span class="admin-tag">ADMIN</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('admin.index') }}" class="nav-link active">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link">Products</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                    <a href="{{ route('admin.reviews.index') }}" class="nav-link">Reviews</a>
                    <a href="{{ route('admin.settings') }}" class="nav-link">Settings</a>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <div class="profile-dropdown-wrapper">
                        <button class="profile-icon-btn" aria-label="User Account" onclick="toggleNav();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </button>
                        <div class="profile-menu">
                            <div class="profile-menu-header">
                                <div class="user-name">Admin Account</div>
                                <div class="user-desc">Store Master Controls</div>
                            </div>
                            <a href="{{ route('user.index') }}" class="profile-menu-link">🌐 Storefront</a>
                            <a href="{{ route('admin.settings') }}" class="profile-menu-link">⚙️ Site Settings</a>
                            <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 6px;">
                                @csrf
                                <button type="submit" style="width:100%; background:#ef4444; color:#fff; border:none; padding:8px; border-radius:10px; font-weight:700; cursor:pointer;">
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    <button class="cart-btn" onclick="window.location.href='{{ route('user.index') }}'">
                        🛍️ Live Store
                    </button>
                    <button class="expand-toggle" aria-label="Toggle Navigation" onclick="toggleNav();">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </button>
                </div>
            </div>

            <!-- Expanded Drawer -->
            <div class="nav-expanded-content">
                <div class="drawer-grid" style="padding-top: 14px;">
                    <div class="drawer-section">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; text-transform: uppercase;">ADMIN NAVIGATION</div>
                        <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 10px;">
                            <a href="{{ route('admin.products.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">📦 Products Catalog Manager</a>
                            <a href="{{ route('admin.users.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">👥 Registered User Accounts</a>
                            <a href="{{ route('admin.reviews.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">⭐ Customer Ratings & Reviews</a>
                        </div>
                    </div>
                    <div class="drawer-section">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; text-transform: uppercase;">QUICK LINK</div>
                        <div style="margin-top: 10px;">
                            <a href="{{ route('user.index') }}" style="color: #0f172a; text-decoration: none; font-weight: 700;">Return to Main Marketplace Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- MAIN PAGE CONTENT -->
    <main class="page-wrapper">
        <div class="reveal" style="margin-bottom: 28px;">
            <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.4rem; font-weight: 700; color: #0f172a;">Admin Command Center</h1>
            <p style="color: #64748b; font-size: 0.95rem; margin-top: 4px;">Control center for inventory, platform stats, users, and customer reviews</p>
        </div>

        <!-- BENTO KPI ROW -->
        <div class="reveal reveal-delay-1" style="font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700; color: #0f172a; margin-bottom: 16px;">Key Metrics Overview</div>
        <div class="bento-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 40px;">
            <!-- 1. Total Products -->
            <div class="card-kpi accent-blue reveal reveal-delay-1">
                <div class="kpi-head">
                    <div class="kpi-title-box">
                        <div class="kpi-icon-avatar blue">📦</div>
                        <div>
                            <div class="kpi-title">Total Products</div>
                            <div style="font-size: 0.72rem; color: #64748b; font-weight: 600;">Storefront Items</div>
                        </div>
                    </div>
                    <span class="kpi-badge" style="background: #eff6ff; color: #2563eb;">Catalog</span>
                </div>
                <div class="kpi-value">{{ number_format($totalProducts ?? 0) }}</div>
                <span class="kpi-sub" style="color: #2563eb;">Live catalog items</span>
            </div>

            <!-- 2. Registered Users -->
            <div class="card-kpi accent-green reveal reveal-delay-2">
                <div class="kpi-head">
                    <div class="kpi-title-box">
                        <div class="kpi-icon-avatar green">👥</div>
                        <div>
                            <div class="kpi-title">Registered Users</div>
                            <div style="font-size: 0.72rem; color: #64748b; font-weight: 600;">Customer Accounts</div>
                        </div>
                    </div>
                    <span class="kpi-badge" style="background: #ecfdf5; color: #10b981;">Users</span>
                </div>
                <div class="kpi-value">{{ number_format($totalUsers ?? 0) }}</div>
                <span class="kpi-sub" style="color: #16a34a;">↑ Active store accounts</span>
            </div>

            <!-- 3. Customer Reviews -->
            <div class="card-kpi accent-amber reveal reveal-delay-3">
                <div class="kpi-head">
                    <div class="kpi-title-box">
                        <div class="kpi-icon-avatar amber">💬</div>
                        <div>
                            <div class="kpi-title">Customer Reviews</div>
                            <div style="font-size: 0.72rem; color: #64748b; font-weight: 600;">Buyer Feedback</div>
                        </div>
                    </div>
                    <span class="kpi-badge" style="background: #fffbeb; color: #d97706;">Ratings</span>
                </div>
                <div class="kpi-value">{{ number_format($totalReviews ?? 0) }}</div>
                <span class="kpi-sub" style="color: #d97706;">★ Verified feedback</span>
            </div>

            <!-- 4. Avg Store Rating -->
            <div class="card-kpi accent-amber reveal reveal-delay-4">
                <div class="kpi-head">
                    <div class="kpi-title-box">
                        <div class="kpi-icon-avatar amber">⭐</div>
                        <div>
                            <div class="kpi-title">Average Rating</div>
                            <div style="font-size: 0.72rem; color: #64748b; font-weight: 600;">Satisfaction Index</div>
                        </div>
                    </div>
                    <span class="kpi-badge" style="background: #fffbeb; color: #d97706;">Score</span>
                </div>
                <div class="kpi-value">{{ $avgRating ?? 5.0 }} <span style="font-size: 1.2rem; color: #f59e0b;">★</span></div>
                <span class="kpi-sub" style="color: #f59e0b;">Product satisfaction score</span>
            </div>

            <!-- 5. Total Inventory Stock -->
            <div class="card-kpi accent-purple reveal reveal-delay-1">
                <div class="kpi-head">
                    <div class="kpi-title-box">
                        <div class="kpi-icon-avatar purple">🏭</div>
                        <div>
                            <div class="kpi-title">Inventory Stock</div>
                            <div style="font-size: 0.72rem; color: #64748b; font-weight: 600;">Warehouse Quantity</div>
                        </div>
                    </div>
                    <span class="kpi-badge" style="background: #f5f3ff; color: #8b5cf6;">Stock</span>
                </div>
                <div class="kpi-value">{{ number_format($totalInventoryStock ?? 0) }}</div>
                <span class="kpi-sub" style="color: #7c3aed;">Total units in warehouse</span>
            </div>

            <!-- 6. Total Catalog Valuation -->
            <div class="card-kpi accent-green reveal reveal-delay-2">
                <div class="kpi-head">
                    <div class="kpi-title-box">
                        <div class="kpi-icon-avatar green">💰</div>
                        <div>
                            <div class="kpi-title">Catalog Valuation</div>
                            <div style="font-size: 0.72rem; color: #64748b; font-weight: 600;">Gross Asset Value</div>
                        </div>
                    </div>
                    <span class="kpi-badge" style="background: #ecfdf5; color: #10b981;">Valuation</span>
                </div>
                <div class="kpi-value">₹{{ number_format($totalCatalogValue ?? 0) }}</div>
                <span class="kpi-sub" style="color: #16a34a;">↑ Live gross inventory value</span>
            </div>
        </div>

        <!-- ANALYTICS & TRAFFIC DASHBOARD SECTION -->
        <div class="reveal reveal-delay-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <!-- System Analytics (Catalog & User Growth) -->
            <div class="bento-table-card" style="margin-bottom: 0;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <div style="font-family: 'Space Grotesk', sans-serif; font-size: 1.3rem; font-weight: 700; color: #0f172a;">Platform Growth Analytics</div>
                        <div style="font-size: 0.8rem; color: #64748b; margin-top: 2px;">Monthly Product Additions & User Signups</div>
                    </div>
                    <span class="kpi-badge" style="background: #2563eb;">DB Analytics</span>
                </div>
                <div style="height: 240px; width: 100%; position: relative;">
                    <canvas id="systemAnalyticsChart"></canvas>
                </div>
            </div>

            <!-- Ratings Breakdown Chart -->
            <div class="bento-table-card" style="margin-bottom: 0;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <div style="font-family: 'Space Grotesk', sans-serif; font-size: 1.3rem; font-weight: 700; color: #0f172a;">Customer Ratings Breakdown</div>
                        <div style="font-size: 0.8rem; color: #64748b; margin-top: 2px;">Distribution of 1-Star to 5-Star Reviews</div>
                    </div>
                    <span class="kpi-badge" style="background: #16a34a;">Realtime DB</span>
                </div>
                <div style="height: 240px; width: 100%; position: relative;">
                    <canvas id="ratingsBreakdownChart"></canvas>
                </div>
            </div>
        </div>

        <!-- RECENT DB ACTIVITY TABLES -->
        <div class="reveal reveal-delay-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 24px;">
            <!-- Recent Products -->
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div class="catalog-section-title" style="margin-bottom: 0;">Latest Products</div>
                    <a href="{{ route('admin.products.index') }}" style="color: #2563eb; font-weight: 700; font-size: 0.85rem; text-decoration: none;">View All Products →</a>
                </div>
                <div class="bento-table-card">
                    <table class="aura-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProducts as $prod)
                                @php
                                    $imgObj = $prod->primaryImage ?? ($prod->images ? $prod->images->first() : null);
                                    $imgPath = $imgObj ? $imgObj->image : null;
                                    if ($imgPath) {
                                        if (\Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://'])) {
                                            $imgUrl = $imgPath;
                                        } elseif (\Illuminate\Support\Str::startsWith($imgPath, 'storage/')) {
                                            $imgUrl = asset($imgPath);
                                        } elseif (file_exists(public_path('storage/' . $imgPath))) {
                                            $imgUrl = asset('storage/' . $imgPath);
                                        } else {
                                            $imgUrl = asset($imgPath);
                                        }
                                    } else {
                                        $imgUrl = null;
                                    }
                                @endphp
                                <tr>
                                    <td style="display: flex; align-items: center; gap: 10px;">
                                        @if($imgUrl)
                                            <img src="{{ $imgUrl }}" style="width: 36px; height: 36px; border-radius: 8px; object-fit: cover;" onerror="this.onerror=null;this.src='https://via.placeholder.com/36';">
                                        @else
                                            <div style="width: 36px; height: 36px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">📦</div>
                                        @endif
                                        <div>
                                            <div style="font-weight: 700;">{{ Str::limit($prod->name, 20) }}</div>
                                            <div style="font-size: 0.75rem; color: #64748b;">#{{ $prod->id }}</div>
                                        </div>
                                    </td>
                                    <td><span class="table-badge pending" style="background: #f1f5f9; color: #475569;">{{ is_object($prod->category) ? ($prod->category->name ?? 'General') : ($prod->category ?? 'General') }}</span></td>
                                    <td><strong>₹{{ number_format($prod->price, 2) }}</strong></td>
                                    <td><span class="table-badge success">{{ $prod->stock }} in stock</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" style="text-align: center; color: #64748b;">No products in database.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Reviews -->
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div class="catalog-section-title" style="margin-bottom: 0;">Latest Customer Reviews</div>
                    <a href="{{ route('admin.reviews.index') }}" style="color: #2563eb; font-weight: 700; font-size: 0.85rem; text-decoration: none;">Manage Reviews →</a>
                </div>
                <div class="bento-table-card">
                    <table class="aura-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>User</th>
                                <th>Rating</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReviews as $rev)
                                <tr>
                                    <td><strong>{{ Str::limit($rev->product->name ?? 'Product #'.$rev->product_id, 18) }}</strong></td>
                                    <td>{{ $rev->user_name }}</td>
                                    <td><span class="table-badge success" style="background: #f0fdf4; color: #16a34a;">{{ $rev->rating }} ★</span></td>
                                    <td style="font-size: 0.8rem; color: #64748b;">{{ $rev->created_at ? $rev->created_at->diffForHumans() : 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" style="text-align: center; color: #64748b;">No customer reviews recorded yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleNav() {
            document.getElementById('dynamicNavbar').classList.toggle('expanded');
        }

        document.addEventListener('click', function(e) {
            const navbar = document.getElementById('dynamicNavbar');
            if (navbar && !navbar.contains(e.target) && navbar.classList.contains('expanded')) {
                navbar.classList.remove('expanded');
            }
        });

        // 1. Platform Growth Analytics Chart (Dynamic from DB)
        const ctxAnalytics = document.getElementById('systemAnalyticsChart').getContext('2d');
        new Chart(ctxAnalytics, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [
                    {
                        label: 'Products Added',
                        data: @json($monthlyProducts),
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.08)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointBackgroundColor: '#2563eb'
                    },
                    {
                        label: 'New Accounts',
                        data: @json($monthlyUsers),
                        borderColor: '#16a34a',
                        backgroundColor: 'transparent',
                        tension: 0.4,
                        borderWidth: 2.5,
                        pointRadius: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 }, boxWidth: 12 } }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { color: '#f1f5f9' }, ticks: { font: { family: 'Plus Jakarta Sans' }, precision: 0 } }
                }
            }
        });

        // 2. Customer Ratings Breakdown Chart (Dynamic from DB)
        const ctxRatings = document.getElementById('ratingsBreakdownChart').getContext('2d');
        new Chart(ctxRatings, {
            type: 'bar',
            data: {
                labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star'],
                datasets: [{
                    label: 'Reviews Count',
                    data: @json(array_values($ratingsCount)),
                    backgroundColor: ['#16a34a', '#2563eb', '#f59e0b', '#dc2626', '#991b1b'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { color: '#f1f5f9' }, ticks: { font: { family: 'Plus Jakarta Sans' }, precision: 0 } }
                }
            }
        });

        // 3. Scroll Reveal Observer Script
        document.addEventListener('DOMContentLoaded', function() {
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -40px 0px'
            });

            reveals.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
