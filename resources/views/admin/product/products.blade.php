<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Manager — UnCart Admin</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.06) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(16, 185, 129, 0.06) 0px, transparent 50%);
            background-attachment: fixed;
            color: #0f172a;
            overflow-x: hidden;
            width: 100%;
        }

        /* Scroll Reveal Utility Classes */
        .reveal {
            opacity: 0;
            transform: translateY(24px) scale(0.98);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* -------------------------------------------------------------
           DYNAMIC ISLAND NAVBAR ANIMATIONS
        ------------------------------------------------------------- */
        @keyframes navSlideDown {
            from { opacity: 0; transform: translateY(-30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

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
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            color: #0f172a;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08),
                        0 0 0 1px rgba(15, 23, 42, 0.06);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            width: 820px;
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

        .nav-left:hover { transform: translateX(2px); }

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
            transition: background 0.25s ease;
        }

        .nav-left:hover .admin-tag { background: #2563eb; }

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

        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link.active { color: #2563eb; font-weight: 700; }

        /* Profile Dropdown */
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
            padding: 8px 16px;
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
            width: 840px;
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

        /* Flash Banner */
        .alert-banner {
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 24px;
            font-weight: 700;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

        /* -------------------------------------------------------------
           PAGE CONTENT CONTAINER
        ------------------------------------------------------------- */
        .page-wrapper {
            width: 100%;
            max-width: 1760px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        .filter-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-input {
            flex: 1;
            min-width: 260px;
            padding: 10px 16px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.88rem;
            font-weight: 600;
            color: #0f172a;
            outline: none;
        }

        .search-input:focus { border-color: #2563eb; }

        .filter-select {
            padding: 10px 16px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.88rem;
            font-weight: 600;
            color: #0f172a;
            outline: none;
            cursor: pointer;
        }

        .bento-table-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 32px; padding: 32px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.03); overflow-x: auto; }
        .aura-table { width: 100%; border-collapse: collapse; text-align: left; }
        .aura-table th { padding: 14px 12px; color: #64748b; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; border-bottom: 1.5px solid #f1f5f9; letter-spacing: 0.5px; }
        .aura-table td { padding: 16px 12px; color: #0f172a; font-size: 0.88rem; font-weight: 600; border-bottom: 1px solid #f8fafc; vertical-align: middle; }

        /* Gallery Thumbnails Grid */
        .image-gallery-strip {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .product-thumb-wrapper {
            position: relative;
            width: 42px;
            height: 42px;
            display: inline-block;
            flex-shrink: 0;
        }

        .product-thumb { width: 42px; height: 42px; border-radius: 10px; object-fit: cover; border: 1px solid #e2e8f0; }

        .primary-badge {
            position: absolute;
            bottom: -3px;
            right: -3px;
            background: #2563eb;
            color: white;
            font-size: 0.55rem;
            font-weight: 800;
            padding: 1px 3px;
            border-radius: 4px;
            text-transform: uppercase;
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

        .badge-status.active { background: #f0fdf4; color: #16a34a; }
        .badge-status.inactive { background: #fef2f2; color: #ef4444; }

        .badge-featured {
            background: #fefce8;
            color: #ca8a04;
            border: 1px solid #fef08a;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .badge-standard {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .price-current { font-weight: 700; color: #0f172a; }
        .price-old { font-size: 0.78rem; color: #94a3b8; text-decoration: line-through; margin-left: 4px; }
        .sku-code { font-family: monospace; font-size: 0.8rem; background: #f1f5f9; padding: 2px 6px; border-radius: 6px; color: #475569; }
        .slug-code { font-size: 0.75rem; color: #64748b; font-weight: 500; }

        .action-circle-btn { background: #f1f5f9; border: 1px solid #e2e8f0; color: #0f172a; padding: 8px 14px; border-radius: 12px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease; margin-right: 4px; display: inline-flex; align-items: center; justify-content: center; }
        .action-circle-btn.delete { color: #ef4444; background: #fef2f2; border-color: #fecaca; }
        .action-circle-btn:hover { background: #0f172a; color: #ffffff; border-color: #0f172a; }

        /* Modal */
        .modal { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(10px); display: none; align-items: center; justify-content: center; z-index: 2000; padding: 20px; overflow-y: auto; }
        .modal.active { display: flex; }
        .modal-card { background: #ffffff; border-radius: 32px; padding: 32px; width: 100%; max-width: 760px; box-shadow: 0 25px 50px rgba(15, 23, 42, 0.15); max-height: 90vh; overflow-y: auto; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 16px; }
        .form-group.full { grid-column: span 2; }
        .form-label { display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 6px; }
        .form-input, .form-textarea, .form-select { width: 100%; padding: 11px 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; font-size: 0.88rem; font-weight: 600; color: #0f172a; outline: none; transition: border-color 0.2s ease; }
        .form-input:focus, .form-textarea:focus, .form-select:focus { border-color: #2563eb; background: #ffffff; }
        .form-textarea { resize: vertical; min-height: 80px; font-family: inherit; }

        .checkbox-group { display: flex; align-items: center; gap: 10px; margin-top: 8px; }
        .checkbox-group input[type="checkbox"] { width: 18px; height: 18px; accent-color: #2563eb; cursor: pointer; }

        .section-header { font-family: 'Space Grotesk', sans-serif; font-size: 0.95rem; font-weight: 700; color: #2563eb; margin: 12px 0 10px; border-bottom: 1px solid #e2e8f0; padding-bottom: 4px; grid-column: span 2; }

        .image-slots-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; grid-column: span 2; background: #f8fafc; padding: 16px; border-radius: 18px; border: 1px dashed #cbd5e1; }
        .image-slot-card { background: #ffffff; border: 1px solid #e2e8f0; padding: 12px; border-radius: 12px; }
        .image-slot-title { font-size: 0.78rem; font-weight: 800; color: #0f172a; margin-bottom: 6px; display: flex; justify-content: space-between; }

        /* iOS Dark Confirmation Alert Modal */
        .ios-alert-backdrop { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.65); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); display: none; align-items: center; justify-content: center; z-index: 3000; padding: 20px; }
        .ios-alert-backdrop.active { display: flex; }
        .ios-alert-card { background: #1c1c1e; color: #ffffff; border-radius: 28px; width: 100%; max-width: 320px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.1); overflow: hidden; text-align: center; animation: iosPop 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        @keyframes iosPop {
            from { opacity: 0; transform: scale(0.85); }
            to { opacity: 1; transform: scale(1); }
        }
        .ios-alert-body { padding: 24px 20px 20px; }
        .ios-alert-icons { display: flex; justify-content: center; align-items: center; margin-bottom: 16px; }
        .ios-alert-icon-box { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; color: #ffffff; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); }
        .ios-alert-icon-box.trash { background: linear-gradient(135deg, #ff453a, #ff3b30); }
        .ios-alert-icon-box.uncart { background: linear-gradient(135deg, #ff9500, #ff8c00); margin-right: -10px; z-index: 2; border: 2px solid #1c1c1e; }
        .ios-alert-icon-box.product { background: linear-gradient(135deg, #0a84ff, #007aff); z-index: 1; border: 2px solid #1c1c1e; }
        .ios-alert-title { font-size: 1.05rem; font-weight: 700; color: #ffffff; margin-bottom: 8px; line-height: 1.35; letter-spacing: -0.2px; }
        .ios-alert-desc { font-size: 0.82rem; color: #8e8e93; line-height: 1.45; font-weight: 400; }
        .ios-alert-actions { display: flex; border-top: 0.5px solid rgba(255, 255, 255, 0.15); width: 100%; }
        .ios-alert-btn { flex: 1; background: transparent; border: none; padding: 14px 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: background 0.15s ease; color: #0a84ff; outline: none; }
        .ios-alert-btn:first-child { border-right: 0.5px solid rgba(255, 255, 255, 0.15); font-weight: 400; color: #8e8e93; }
        .ios-alert-btn.danger { color: #ff453a; font-weight: 700; }
        .ios-alert-btn:active { background: rgba(255, 255, 255, 0.1); }

        @media (max-width: 900px) {
            .nav-container { top: auto !important; bottom: 16px !important; }
            .navbar { width: 100% !important; border-radius: 28px; }
            .nav-links { display: none; }
            .page-wrapper { padding: 24px 16px 120px !important; }
            .form-grid, .image-slots-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: span 1; }
            .section-header { grid-column: span 1; }
        }
    </style>
</head>
<body>

    <!-- DYNAMIC ISLAND NAVBAR -->
    <div class="nav-container">
        <nav class="navbar" id="dynamicNavbar">
            <div class="nav-header">
                <a href="../index.blade.php" class="nav-left">
                    <div class="brand-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div>
                    <span class="brand-name">UnCart</span>
                    <span class="admin-tag">ADMIN</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('admin.index') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link active">Products</a>
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

                    <button class="cart-btn" onclick="openAddModal()">
                        + Add Product
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
                            <a href="{{ route('admin.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">📊 Main Dashboard Overview</a>
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

    <main class="page-wrapper">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert-banner alert-success">
                <span>✅ {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" style="background:none; border:none; color:inherit; cursor:pointer; font-size:1.1rem;">✕</button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-banner alert-error">
                <div>
                    <strong>⚠️ Please check form errors:</strong>
                    <ul style="margin-top: 6px; padding-left: 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.remove()" style="background:none; border:none; color:inherit; cursor:pointer; font-size:1.1rem;">✕</button>
            </div>
        @endif

        <div class="reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; flex-wrap: wrap; gap: 16px;">
            <div>
                <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.4rem; font-weight: 700; color: #0f172a;">Products Manager</h1>
                <p style="color: #64748b; font-size: 0.95rem; margin-top: 4px;">Manage product listings with support for 4+ product images per item</p>
            </div>
            <button class="cart-btn" style="padding: 12px 24px; font-size: 0.9rem;" onclick="openAddModal()">+ Add New Product</button>
        </div>

        <!-- Filter & Search Controls -->
        <div class="filter-bar reveal">
            <input type="text" id="searchInput" class="search-input" placeholder="Search products by title, SKU, or slug..." onkeyup="filterProducts()">
            <select id="statusFilter" class="filter-select" onchange="filterProducts()">
                <option value="all">All Statuses</option>
                <option value="1">Active Only</option>
                <option value="0">Inactive Only</option>
            </select>
            <select id="featuredFilter" class="filter-select" onchange="filterProducts()">
                <option value="all">All Items</option>
                <option value="1">Featured Only</option>
                <option value="0">Standard Only</option>
            </select>
        </div>

        <!-- Bento Table Card -->
        <div class="bento-table-card reveal">
            <table class="aura-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>4+ Product Images (`product_images`)</th>
                        <th>Product & Slug</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Pricing (INR)</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    @forelse($products as $product)
                        @php
                            $imagesList = $product->images;
                            $imgsJson = json_encode($imagesList->pluck('image')->toArray());
                        @endphp
                        @php
                            $imagesList = $product->images;
                            $imgsJson = json_encode($imagesList->pluck('image')->toArray());
                            $specsJson = json_encode($product->specifications->map(fn($s) => ['key' => $s->spec_key, 'val' => $s->spec_value])->values()->toArray());
                            $faqsJson = json_encode($product->faqs->map(fn($f) => ['q' => $f->question, 'a' => $f->answer])->values()->toArray());
                        @endphp
                        <tr data-id="{{ $product->id }}" 
                            data-name="{{ $product->name }}"
                            data-slug="{{ $product->slug }}"
                            data-sku="{{ $product->sku }}"
                            data-category="{{ $product->category_id }}"
                            data-price="{{ $product->price }}"
                            data-oldprice="{{ $product->old_price }}"
                            data-stock="{{ $product->stock }}"
                            data-status="{{ $product->status ? '1' : '0' }}"
                            data-featured="{{ $product->featured ? '1' : '0' }}"
                            data-description="{{ $product->description }}"
                            data-images='{{ $imgsJson }}'
                            data-specs='{{ $specsJson }}'
                            data-faqs='{{ $faqsJson }}'>
                            <td><strong>#{{ $product->id }}</strong></td>
                            <td>
                                <div class="image-gallery-strip">
                                        @forelse($imagesList->take(4) as $idx => $imgObj)
                                            @php
                                                $imgSrcUrl = \Illuminate\Support\Str::startsWith($imgObj->image, ['http://', 'https://']) ? $imgObj->image : asset($imgObj->image);
                                            @endphp
                                            <div class="product-thumb-wrapper">
                                                <img src="{{ $imgSrcUrl }}" class="product-thumb" alt="Product Image {{ $idx+1 }}" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';">
                                                @if($imgObj->is_primary || $idx === 0)
                                                    <span class="primary-badge" title="Primary Product Image">PRI</span>
                                                @endif
                                            </div>
                                    @empty
                                        <span style="font-size:0.75rem; color:#94a3b8;">No images</span>
                                    @endforelse
                                </div>
                            </td>
                            <td>
                                <div><strong>{{ $product->name }}</strong></div>
                                <div class="slug-code">{{ $product->slug }}</div>
                            </td>
                            <td><span class="sku-code">{{ $product->sku }}</span></td>
                            @php
                                $matchedCat = isset($categories) ? $categories->firstWhere('id', $product->category_id) : null;
                            @endphp
                            <td>
                                @if($matchedCat)
                                    <span style="font-weight: 700; color: #0f172a;">{{ $matchedCat->icon_emoji ?? '' }} {{ $matchedCat->name }}</span>
                                @else
                                    <span style="color: #64748b;">Cat #{{ $product->category_id ?? 'N/A' }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="price-current">₹{{ number_format($product->price, 2) }}</span>
                                @if($product->old_price)
                                    <span class="price-old">₹{{ number_format($product->old_price, 2) }}</span>
                                @endif
                            </td>
                            <td>
                                <span style="color: {{ $product->stock > 5 ? '#16a34a' : '#d97706' }}; font-weight: 700;">
                                    {{ $product->stock ?? 0 }} in stock
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
                                @if($product->featured)
                                    <span class="badge-featured">★ Featured</span>
                                @else
                                    <span class="badge-standard">Standard</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <button class="action-circle-btn" onclick="editProductRow(this)">Edit</button>
                                    <button type="button" 
                                            class="action-circle-btn delete" 
                                            onclick="openIosDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="text-align: center; padding: 40px; color: #64748b;">
                                📦 No products found. Click <strong>+ Add New Product</strong> above to add one with 4 pictures!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- DYNAMIC ADD / EDIT PRODUCT MODAL WITH 4 IMAGE SLOTS, SPECS & FAQS -->
    <div class="modal" id="productModal">
        <div class="modal-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 id="modalTitle" style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem;">Add New Product</h2>
                <button onclick="closeModal()" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; color: #64748b;">✕</button>
            </div>

            <form id="productForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="methodSpoof"></div>
                <input type="hidden" id="editRowId" value="">

                <div class="form-grid">
                    <!-- General Details -->
                    <div class="section-header">Basic Details</div>

                    <div class="form-group">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" id="pName" class="form-input" placeholder="e.g. Ergonomic Keyboard" required oninput="autoGenerateSlug()">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="pSlug" class="form-input" placeholder="e.g. ergonomic-keyboard" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" id="pSku" class="form-input" placeholder="e.g. SKU-KEY-004" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category_id" id="pCategoryId" class="form-select">
                            <option value="">-- Select Category --</option>
                            @if(isset($categories) && count($categories) > 0)
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->icon_emoji ?? '📦' }} {{ $cat->name }} (#{{ $cat->id }})</option>
                                @endforeach
                            @else
                                <option value="1">1 - Audio Gear</option>
                                <option value="2">2 - Gaming Hardware</option>
                                <option value="3">3 - Luxury Furniture</option>
                                <option value="4">4 - Accessories & Tech</option>
                            @endif
                        </select>
                    </div>

                    <!-- Pricing & Stock -->
                    <div class="section-header">Pricing & Stock Schema</div>

                    <div class="form-group">
                        <label class="form-label">Price (`price` ₹)</label>
                        <input type="number" step="0.01" name="price" id="pPrice" class="form-input" placeholder="14999.00" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Old Price (`old_price` ₹)</label>
                        <input type="number" step="0.01" name="old_price" id="pOldPrice" class="form-input" placeholder="18999.00">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Stock Quantity (`stock`)</label>
                        <input type="number" name="stock" id="pStock" class="form-input" placeholder="25" value="10" required>
                    </div>

                    <!-- Status & Flags -->
                    <div class="form-group">
                        <label class="form-label">Status (`status`)</label>
                        <select name="status" id="pStatus" class="form-select">
                            <option value="1">Active (1)</option>
                            <option value="0">Inactive (0)</option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <div class="checkbox-group">
                            <input type="checkbox" name="featured" value="1" id="pFeatured">
                            <label for="pFeatured" class="form-label" style="margin: 0; cursor: pointer;">Mark as Featured Product (`featured` = 1)</label>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group full">
                        <label class="form-label">Description (`description`)</label>
                        <textarea name="description" id="pDescription" class="form-textarea" placeholder="Detailed product specifications and description..."></textarea>
                    </div>

                    <!-- Product Images Schema (4 Pictures) -->
                    <div class="section-header">Product Images (`product_images` table — Minimum 4 Pictures)</div>

                    <div class="form-group full">
                        <label class="form-label">Upload Multiple Images at Once (`image_files[]`)</label>
                        <input type="file" name="image_files[]" id="pImageFilesMulti" class="form-input" accept="image/*" multiple>
                    </div>

                    <div class="image-slots-grid">
                        <div class="image-slot-card">
                            <div class="image-slot-title">
                                <span>IMAGE 1 (PRIMARY)</span>
                                <span style="color:#2563eb; font-weight:800;">`is_primary = 1`</span>
                            </div>
                            <input type="text" name="images[]" id="pImg1" class="form-input" placeholder="Image 1 Path or URL (e.g. https://...)" value="">
                        </div>
                        <div class="image-slot-card">
                            <div class="image-slot-title">
                                <span>IMAGE 2</span>
                                <span style="color:#64748b;">`is_primary = 0`</span>
                            </div>
                            <input type="text" name="images[]" id="pImg2" class="form-input" placeholder="Image 2 Path or URL" value="">
                        </div>
                        <div class="image-slot-card">
                            <div class="image-slot-title">
                                <span>IMAGE 3</span>
                                <span style="color:#64748b;">`is_primary = 0`</span>
                            </div>
                            <input type="text" name="images[]" id="pImg3" class="form-input" placeholder="Image 3 Path or URL" value="">
                        </div>
                        <div class="image-slot-card">
                            <div class="image-slot-title">
                                <span>IMAGE 4</span>
                                <span style="color:#64748b;">`is_primary = 0`</span>
                            </div>
                            <input type="text" name="images[]" id="pImg4" class="form-input" placeholder="Image 4 Path or URL" value="">
                        </div>
                    </div>

                    <!-- Technical Specifications Section -->
                    <div class="section-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Technical Specifications (`product_specifications`)</span>
                        <button type="button" class="action-circle-btn" onclick="addSpecRow()" style="font-size: 0.78rem;">+ Add Spec Row</button>
                    </div>
                    <div class="form-group full" id="specsContainer"></div>

                    <!-- Product FAQs Section -->
                    <div class="section-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Product Q&As (`product_faqs`)</span>
                        <button type="button" class="action-circle-btn" onclick="addFaqRow()" style="font-size: 0.78rem;">+ Add FAQ Row</button>
                    </div>
                    <div class="form-group full" id="faqsContainer"></div>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 24px;">
                    <button type="submit" class="cart-btn" style="flex: 1; justify-content: center; padding: 14px;">Save Product Master</button>
                    <button type="button" class="action-circle-btn" onclick="closeModal()" style="padding: 14px 20px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

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

        function autoGenerateSlug() {
            const name = document.getElementById('pName').value;
            const slug = name.toLowerCase()
                             .trim()
                             .replace(/[^\w\s-]/g, '')
                             .replace(/[\s_-]+/g, '-')
                             .replace(/^-+|-+$/g, '');
            document.getElementById('pSlug').value = slug;
        }

        function addSpecRow(key = '', val = '') {
            const container = document.getElementById('specsContainer');
            const div = document.createElement('div');
            div.style.cssText = 'display:flex; gap:10px; margin-bottom:8px; align-items:center;';
            div.innerHTML = `
                <input type="text" name="spec_keys[]" class="form-input" placeholder="Spec Name (e.g. Connectivity)" value="${key}" style="flex:1;">
                <input type="text" name="spec_values[]" class="form-input" placeholder="Spec Detail (e.g. Bluetooth 5.3)" value="${val}" style="flex:1.5;">
                <button type="button" class="action-circle-btn delete" onclick="this.parentElement.remove()" style="padding:8px 12px;">✕</button>
            `;
            container.appendChild(div);
        }

        function addFaqRow(q = '', a = '') {
            const container = document.getElementById('faqsContainer');
            const div = document.createElement('div');
            div.style.cssText = 'display:flex; flex-direction:column; gap:6px; margin-bottom:12px; background:#f8fafc; padding:12px; border-radius:14px; border:1px solid #e2e8f0;';
            div.innerHTML = `
                <div style="display:flex; gap:10px; align-items:center;">
                    <input type="text" name="faq_questions[]" class="form-input" placeholder="Question (e.g. What is in the box?)" value="${q}" style="flex:1;">
                    <button type="button" class="action-circle-btn delete" onclick="this.parentElement.parentElement.remove()" style="padding:8px 12px;">✕</button>
                </div>
                <textarea name="faq_answers[]" class="form-textarea" placeholder="Answer..." style="min-height:50px;">${a}</textarea>
            `;
            container.appendChild(div);
        }

        function openAddModal() {
            document.getElementById('modalTitle').innerText = "Add New Product";
            document.getElementById('editRowId').value = "";
            document.getElementById('productForm').action = "{{ route('admin.products.store') }}";
            document.getElementById('methodSpoof').innerHTML = "";
            document.getElementById('productForm').reset();
            document.getElementById('pStatus').value = "1";
            document.getElementById('pImg1').value = "";
            document.getElementById('pImg2').value = "";
            document.getElementById('pImg3').value = "";
            document.getElementById('pImg4').value = "";

            document.getElementById('specsContainer').innerHTML = "";
            document.getElementById('faqsContainer').innerHTML = "";
            addSpecRow('Model Name', '');
            addSpecRow('Connectivity', 'Bluetooth 5.3');
            addFaqRow('Is warranty included?', 'Yes, 2 Year Official Warranty.');

            document.getElementById('productModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('productModal').classList.remove('active');
        }

        function editProductRow(btn) {
            const tr = btn.closest('tr');
            const rowId = tr.dataset.id;
            
            document.getElementById('modalTitle').innerText = "Edit Product #" + rowId;
            document.getElementById('editRowId').value = rowId;
            
            document.getElementById('productForm').action = "{{ url('/admin/products') }}/" + rowId;
            document.getElementById('methodSpoof').innerHTML = '@method("PUT")';

            document.getElementById('pName').value = tr.dataset.name || '';
            document.getElementById('pSlug').value = tr.dataset.slug || '';
            document.getElementById('pSku').value = tr.dataset.sku || '';
            document.getElementById('pCategoryId').value = tr.dataset.category || '1';
            document.getElementById('pPrice').value = tr.dataset.price || '';
            document.getElementById('pOldPrice').value = tr.dataset.oldprice || '';
            document.getElementById('pStock').value = tr.dataset.stock || '0';
            document.getElementById('pStatus').value = tr.dataset.status || '1';
            document.getElementById('pFeatured').checked = tr.dataset.featured === '1';
            document.getElementById('pDescription').value = tr.dataset.description || '';

            try {
                const imgs = JSON.parse(tr.dataset.images || '[]');
                document.getElementById('pImg1').value = imgs[0] || '';
                document.getElementById('pImg2').value = imgs[1] || '';
                document.getElementById('pImg3').value = imgs[2] || '';
                document.getElementById('pImg4').value = imgs[3] || '';
            } catch (e) {
                console.error("Error parsing images JSON", e);
            }

            // Specs
            document.getElementById('specsContainer').innerHTML = "";
            try {
                const specs = JSON.parse(tr.dataset.specs || '[]');
                if (specs.length > 0) {
                    specs.forEach(s => addSpecRow(s.key, s.val));
                } else {
                    addSpecRow('Model Name', tr.dataset.name || '');
                }
            } catch (e) {
                addSpecRow('Model Name', tr.dataset.name || '');
            }

            // FAQs
            document.getElementById('faqsContainer').innerHTML = "";
            try {
                const faqs = JSON.parse(tr.dataset.faqs || '[]');
                if (faqs.length > 0) {
                    faqs.forEach(f => addFaqRow(f.q, f.a));
                } else {
                    addFaqRow('Is warranty included?', 'Yes, 2 Year Official Brand Warranty.');
                }
            } catch (e) {
                addFaqRow('Is warranty included?', 'Yes, 2 Year Official Brand Warranty.');
            }

            document.getElementById('productModal').classList.add('active');
        }
    </script>

    <!-- iOS DARK STYLE DELETE CONFIRMATION MODAL -->
    <div class="ios-alert-backdrop" id="iosDeleteModal">
        <div class="ios-alert-card">
            <div class="ios-alert-body">
                <div class="ios-alert-icons">
                    <div class="ios-alert-icon-box uncart">🛒</div>
                    <div class="ios-alert-icon-box trash">🗑️</div>
                </div>
                <div class="ios-alert-title" id="iosModalTitle">Delete "Product"?</div>
                <div class="ios-alert-desc">
                    This action will permanently delete the product record along with its gallery photos and specs from UnCart.
                </div>
            </div>

            <form id="iosDeleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="ios-alert-actions">
                    <button type="button" class="ios-alert-btn" onclick="closeIosDeleteModal()">Don't Allow</button>
                    <button type="submit" class="ios-alert-btn danger">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openIosDeleteModal(productId, productName) {
            const form = document.getElementById('iosDeleteForm');
            form.action = "{{ url('/admin/products') }}/" + productId;

            document.getElementById('iosModalTitle').innerText = 'Delete "' + productName + '"?';
            document.getElementById('iosDeleteModal').classList.add('active');
        }

        function closeIosDeleteModal() {
            document.getElementById('iosDeleteModal').classList.remove('active');
        }

        // Close when clicking backdrop outside alert card
        document.getElementById('iosDeleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeIosDeleteModal();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeIosDeleteModal();
            }
        });

        function toggleNav() {
            document.getElementById('dynamicNavbar').classList.toggle('expanded');
        }

        document.addEventListener('click', function(e) {
            const navbar = document.getElementById('dynamicNavbar');
            if (navbar && !navbar.contains(e.target) && navbar.classList.contains('expanded')) {
                navbar.classList.remove('expanded');
            }
        });

        function filterProducts() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value;
            const featured = document.getElementById('featuredFilter').value;
            
            const rows = document.querySelectorAll('#productTableBody tr');
            rows.forEach(tr => {
                const text = tr.innerText.toLowerCase();
                const matchQuery = text.includes(query);
                const matchStatus = status === 'all' || tr.dataset.status === status;
                const matchFeatured = featured === 'all' || tr.dataset.featured === featured;

                if (matchQuery && matchStatus && matchFeatured) {
                    tr.style.display = '';
                } else {
                    tr.style.display = 'none';
                }
            });
        }

        // Scroll Reveal Observer Script
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