<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UnCart — Extended Marketplace</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
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

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px) scale(0.97);
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
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
            width: 780px;
            padding: 8px 16px;
        }

        .nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 42px;
            cursor: pointer;
            user-select: none;
            gap: 16px;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
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

        .search-pill-box {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 6px 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-grow: 1;
            max-width: 340px;
        }

        .search-pill-box input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 0.85rem;
            width: 100%;
            color: #0f172a;
            font-weight: 500;
        }

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
            flex-shrink: 0;
        }

        /* User Profile Dropdown Component */
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

        .profile-menu-header .user-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: #0f172a;
        }

        .profile-menu-header .user-desc {
            font-size: 0.75rem;
            color: #64748b;
        }

        .btn-profile-login {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background: #2563eb;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 10px 14px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s ease;
            margin-bottom: 6px;
        }

        .btn-profile-login:hover {
            background: #1d4ed8;
        }

        .profile-menu-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            color: #475569;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.15s ease;
        }

        .profile-menu-link:hover {
            background: #f8fafc;
            color: #0f172a;
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
            flex-shrink: 0;
        }

        /* Expanded Dynamic Island Drawer */
        .nav-expanded-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
        }

        .navbar.expanded {
            width: 820px;
            border-radius: 28px;
            padding-bottom: 16px;
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
           FLIPKART STYLE SEARCH RESULTS LAYOUT (SIDEBAR + VERTICAL LIST)
        ------------------------------------------------------------- */
        .search-page-wrapper {
            max-width: 1760px;
            margin: 0 auto;
            padding: 95px 24px 60px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 28px;
        }

        /* Sidebar Filters */
        .filter-sidebar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 24px;
            height: fit-content;
            position: sticky;
            top: 90px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 20px;
        }

        .sidebar-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
        }

        .clear-btn {
            background: none;
            border: none;
            color: #2563eb;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
        }

        .filter-group {
            margin-bottom: 24px;
        }

        .group-label {
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 12px;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 0.88rem;
            color: #334155;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-option input[type="checkbox"], .checkbox-option input[type="radio"] {
            width: 16px;
            height: 16px;
            accent-color: #2563eb;
            cursor: pointer;
        }

        .price-range-inputs {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .price-range-inputs input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 0.85rem;
            outline: none;
        }

        /* Results Right Main Content */
        .results-header-bar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .results-query-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
        }

        .sort-dropdown {
            padding: 8px 14px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            font-size: 0.85rem;
            font-weight: 600;
            color: #0f172a;
            outline: none;
            background: #ffffff;
            cursor: pointer;
        }

        /* Vertical Full Width Product List Cards (Flipkart Style) */
        .products-list-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-list-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 24px;
            display: grid;
            grid-template-columns: 240px 1fr 220px;
            gap: 24px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .product-list-card:hover {
            transform: translateY(-4px);
            border-color: #cbd5e1;
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.06);
        }

        .list-card-img-box {
            width: 100%;
            height: 200px;
            background: #f8fafc;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .list-card-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-list-card:hover .list-card-img-box img {
            transform: scale(1.06);
        }

        .list-card-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .list-card-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .rating-pill-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .badge-green-stars {
            background: #16a34a;
            color: #ffffff;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .review-count-text {
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 600;
        }

        .list-card-bullets {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-top: 6px;
        }

        .list-card-bullets li {
            font-size: 0.86rem;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .list-card-bullets li::before {
            content: "•";
            color: #2563eb;
            font-weight: bold;
        }

        .list-card-actions-box {
            border-left: 1px solid #f1f5f9;
            padding-left: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .list-price-tag {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .list-old-price {
            font-size: 0.95rem;
            color: #94a3b8;
            text-decoration: line-through;
            margin-bottom: 12px;
        }

        .free-delivery-badge {
            color: #16a34a;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .btn-view-details {
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 10px 16px;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            margin-bottom: 8px;
            transition: background 0.2s ease;
        }

        .btn-view-details:hover {
            background: #2563eb;
        }

        /* SITE FOOTER STYLES */
        .site-footer { background: #0f172a; color: #f8fafc; border-radius: 32px 32px 0 0; padding: 60px 40px 40px; margin-top: 80px; box-shadow: 0 -20px 40px rgba(15, 23, 42, 0.05); }
        .footer-container { max-width: 1760px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 1.5fr; gap: 40px; margin-bottom: 48px; }
        .footer-brand { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .footer-brand .brand-icon { width: 36px; height: 36px; background: #2563eb; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
        .footer-brand .brand-icon svg { width: 20px; height: 20px; fill: #ffffff; }
        .footer-brand .brand-name { font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700; color: #ffffff; }
        .footer-tagline { color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin-bottom: 24px; max-width: 360px; }
        .footer-column h4 { font-family: 'Space Grotesk', sans-serif; font-size: 1.05rem; font-weight: 700; color: #ffffff; margin-bottom: 20px; }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .footer-links a { color: #94a3b8; text-decoration: none; font-size: 0.88rem; font-weight: 500; transition: color 0.2s ease; }
        .footer-links a:hover { color: #38bdf8; }
        .footer-newsletter input { width: 100%; padding: 12px 16px; background: #1e293b; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 14px; color: #ffffff; font-size: 0.88rem; margin-bottom: 10px; outline: none; }
        .footer-newsletter button { width: 100%; padding: 12px 16px; background: #2563eb; color: #ffffff; border: none; border-radius: 14px; font-size: 0.88rem; font-weight: 700; cursor: pointer; transition: background 0.2s ease; }
        .footer-newsletter button:hover { background: #1d4ed8; }
        .footer-bottom { max-width: 1760px; margin: 0 auto; padding-top: 30px; border-top: 1px solid rgba(255, 255, 255, 0.08); display: flex; justify-content: space-between; align-items: center; color: #64748b; font-size: 0.85rem; }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            top: auto;
            background: #0f172a;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 14px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 2500;
            transform: translateY(40px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        @media (max-width: 900px) {
            .nav-container {
                top: auto !important;
                bottom: 16px !important;
                padding: 0 12px;
            }

            .navbar, .navbar.expanded {
                width: 100% !important;
                border-radius: 28px;
                padding: 8px 14px;
                box-shadow: 0 -10px 30px rgba(15, 23, 42, 0.15), 0 0 0 1px rgba(15, 23, 42, 0.08);
            }

            .search-page-wrapper {
                grid-template-columns: 1fr;
                padding: 24px 16px 100px !important;
            }

            .filter-sidebar {
                position: relative;
                top: auto;
            }

            .product-list-card {
                grid-template-columns: 1fr;
            }

            .list-card-actions-box {
                border-left: none;
                border-top: 1px solid #f1f5f9;
                padding-left: 0;
                padding-top: 16px;
            }
        }

    /* ===== PAGE LOADER ===== */
    #pageLoader {
        position: fixed;
        inset: 0;
        background: #ffffff;
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 18px;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    #pageLoader.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    .loader-ring {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        border: 4px solid #e2e8f0;
        border-top-color: #0f172a;
        animation: loaderSpin 0.85s linear infinite;
    }
    .loader-dot-trail {
        display: flex;
        gap: 8px;
    }
    .loader-dot-trail span {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #0f172a;
        animation: loaderDotFade 1.2s ease-in-out infinite;
    }
    .loader-dot-trail span:nth-child(2) { animation-delay: 0.2s; }
    .loader-dot-trail span:nth-child(3) { animation-delay: 0.4s; }
    .loader-brand-label {
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #0f172a;
        opacity: 0.55;
    }
    @keyframes loaderSpin { to { transform: rotate(360deg); } }
    @keyframes loaderDotFade {
        0%, 80%, 100% { opacity: 0.15; transform: scale(0.8); }
        40%            { opacity: 1;    transform: scale(1.2); }
    }
    </style>
</head>
<body>

    <!-- PAGE LOADER -->
    <div id="pageLoader">
        <div class="loader-ring"></div>
        <div class="loader-dot-trail">
            <span></span><span></span><span></span>
        </div>
        <div class="loader-brand-label">UnCart</div>
    </div>

    <!-- DYNAMIC ISLAND NAVBAR -->
    <div class="nav-container">
        <nav class="navbar" id="dynamicNavbar">
            <div class="nav-header">
                <a href="{{ route('user.index') }}" class="nav-left">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                </a>

                <!-- Search Input Pill -->
                <div class="search-pill-box">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" id="pageSearchInput" placeholder="Search headphones, smartwatch, chairs..." onkeyup="handleLiveSearch(event)">
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <!-- User Profile Dropdown Icon -->
                    <div class="profile-dropdown-wrapper">
                        <button class="profile-icon-btn" aria-label="User Account" onclick="toggleNav();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </button>
                        <div class="profile-menu">
                            <div class="profile-menu-header">
                                <div class="user-name">
                                    @if(Auth::guard('user')->check())
                                        {{ Auth::guard('user')->user()->name }}
                                    @else
                                        Welcome Guest
                                    @endif
                                </div>
                                <div class="user-desc">Manage orders & account settings</div>
                            </div>
                            @if(Auth::guard('user')->check())
                                <a href="#" class="btn-profile-login">
                                    👤 {{ Auth::guard('user')->user()->name }}
                                </a>
                                <form action="{{ route('user.logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-profile-login">
                                        🔑 Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('user.login') }}" class="btn-profile-login" onclick="showToast('Redirecting to Login Page...')">
                                    🔑 Login / Sign Up
                                </a>
                            @endif
                            <a href="{{ route('admin.index') }}" class="profile-menu-link" style="color: #38bdf8; font-weight: 700;">⚙️ Admin Panel</a>
                            <a href="{{ route('seller.index') }}" class="profile-menu-link" style="color: #16a34a; font-weight: 700;">🏬 Seller Central</a>
                            <a href="#" class="profile-menu-link" onclick="showToast('Opening My Orders...')">📦 My Orders</a>
                            <a href="#" class="profile-menu-link" onclick="showToast('Opening Wishlist...')">❤️ Saved Wishlist</a>
                            <a href="#" class="profile-menu-link" onclick="showToast('Opening Customer Support...')">🎧 Customer Support</a>
                        </div>
                    </div>

                    <button class="cart-btn" onclick="toggleNav();">
                        🛒 Cart <span class="cart-count" id="cartCount">0</span>
                    </button>
                    <button class="expand-toggle" aria-label="Toggle Navigation" onclick="toggleNav();">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </button>
                </div>
            </div>

            <!-- Drawer -->
            <div class="nav-expanded-content">
                <div class="drawer-grid" style="padding-top: 14px;">
                    <div class="drawer-section">
                        <div style="font-size: 0.75rem; font-weight: 800; color: #64748b; margin-bottom: 8px;">SHOPPING CART</div>
                        <div id="cartItemsList" style="font-size: 0.8rem; color: #64748b;">Cart is empty</div>
                    </div>
                    <div class="drawer-section">
                        <div style="font-size: 0.75rem; font-weight: 800; color: #64748b; margin-bottom: 8px;">NAVIGATION</div>
                        <a href="{{ route('user.index') }}" style="color: #2563eb; text-decoration: none; font-size: 0.85rem; font-weight: 600;">← Back to Home Store</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- MAIN SEARCH PAGE CONTENT -->
    <main class="search-page-wrapper">
        <!-- SIDEBAR FILTERS (FLIPKART STYLE) -->
        <aside class="filter-sidebar">
            <div class="sidebar-header">
                <span class="sidebar-title">Filters</span>
                <button class="clear-btn" onclick="clearAllFilters()">CLEAR ALL</button>
            </div>

            <!-- Category Filter -->
            <div class="filter-group">
                <div class="group-label">Category</div>
                @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $cat)
                        <label class="checkbox-option"><input type="checkbox" value="{{ $cat->name }}" onchange="applyFilters()"> {{ $cat->name }}</label>
                    @endforeach
                @else
                    <label class="checkbox-option"><input type="checkbox" value="Audio" onchange="applyFilters()"> Audio & Electronics</label>
                    <label class="checkbox-option"><input type="checkbox" value="Wearables" onchange="applyFilters()"> Smart Wearables</label>
                    <label class="checkbox-option"><input type="checkbox" value="Gaming" onchange="applyFilters()"> Gaming PC Parts</label>
                    <label class="checkbox-option"><input type="checkbox" value="Furniture" onchange="applyFilters()"> Furniture & Living</label>
                @endif
            </div>

            <!-- Customer Ratings Filter -->
            <div class="filter-group">
                <div class="group-label">Customer Ratings</div>
                <label class="checkbox-option"><input type="radio" name="starRating" value="4.5" onchange="applyFilters()"> 4.5★ & Above</label>
                <label class="checkbox-option"><input type="radio" name="starRating" value="4.0" onchange="applyFilters()"> 4.0★ & Above</label>
                <label class="checkbox-option"><input type="radio" name="starRating" value="3.0" onchange="applyFilters()"> 3.0★ & Above</label>
            </div>

            <!-- Price Range Filter -->
            <div class="filter-group">
                <div class="group-label">Price Range (₹)</div>
                <div class="price-range-inputs">
                    <input type="number" id="minPriceInput" placeholder="Min" onchange="applyFilters()">
                    <span>to</span>
                    <input type="number" id="maxPriceInput" placeholder="Max" onchange="applyFilters()">
                </div>
            </div>
        </aside>

        <!-- MAIN SEARCH RESULTS SECTION -->
        <section>
            <!-- Results Top Header Bar -->
            <div class="results-header-bar">
                <div class="results-query-title" id="searchHeaderQuery">Showing results for "<span id="querySpanText">All Products</span>"</div>
                <select class="sort-dropdown" id="sortSelect" onchange="applyFilters()">
                    <option value="relevance">Sort by: Relevance</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Customer Rating</option>
                </select>
            </div>

            <!-- Vertical Products List Container -->
            <div class="products-list-container" id="productsListContainer">
                <!-- Products dynamically rendered here -->
            </div>
        </section>
    </main>

    <!-- SITE FOOTER -->
    <footer class="site-footer">
        <div class="footer-container">
            <div>
                <div class="footer-brand">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                </div>
                <p class="footer-tagline">
                    Experience futuristic shopping with UnCart. Next-generation tech gear, Scandinavian furniture, and luxury essentials delivered across India.
                </p>
            </div>

            <div class="footer-column">
                <h4>Categories</h4>
                <ul class="footer-links">
                    <li><a href="deals.blade.php">Flash Deals</a></li>
                    <li><a href="product.blade.php?id=headphones">Audio & Tech</a></li>
                    <li><a href="product.blade.php?id=sofa">Luxury Furniture</a></li>
                    <li><a href="product.blade.php?id=gpu">Gaming Gear</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Customer Support</h4>
                <ul class="footer-links">
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns & Refund</a></li>
                    <li><a href="#">Help Center FAQ</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Company</h4>
                <ul class="footer-links">
                    <li><a href="#">About UnCart</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="../admin/index.blade.php">Admin Portal</a></li>
                </ul>
            </div>

            <div class="footer-column footer-newsletter">
                <h4>Stay Updated</h4>
                <p style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 12px;">Subscribe to get exclusive discount codes & weekly deal updates.</p>
                <input type="email" placeholder="Enter your email address">
                <button onclick="showToast('Subscribed to UnCart newsletter!')">Subscribe</button>
            </div>
        </div>

        <div class="footer-bottom">
            <div>© 2026 UnCart Marketplace. All rights reserved.</div>
            <div style="display: flex; gap: 20px;">
                <a href="#" style="color: #64748b; text-decoration: none;">Terms of Service</a>
                <a href="#" style="color: #64748b; text-decoration: none;">Security</a>
                <a href="#" style="color: #64748b; text-decoration: none;">Sitemap</a>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="#38bdf8"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        <span id="toastMsg">Item added to cart!</span>
    </div>

    <script>
        const catalogProducts = [
            @if(isset($products) && count($products) > 0)
                @foreach($products as $prod)
                    @php
                        $imgObj = $prod->primaryImage ?? ($prod->images ? $prod->images->first() : null);
                        $imgPath = $prod->image ?? ($imgObj ? ($imgObj->image_path ?? $imgObj->image) : null);
                        if ($imgPath) {
                            $prodImg = \Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://']) ? $imgPath : asset($imgPath);
                        } else {
                            $prodImg = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                        }
                    @endphp
                    {
                        id: "{{ $prod->id }}",
                        slug: "{{ $prod->slug ?? $prod->id }}",
                        title: @json($prod->name),
                        category: @json($prod->category->name ?? 'General'),
                        price: {{ $prod->price }},
                        oldPrice: {{ $prod->old_price ?? round($prod->price * 1.25) }},
                        rating: {{ round($prod->reviews->avg('rating') ?? 4.8, 1) }},
                        reviews: {{ $prod->reviews->count() > 0 ? $prod->reviews->count() : rand(50, 1500) }},
                        img: "{{ $prodImg }}",
                        bullets: [
                            @if($prod->description)
                                @json(Illuminate\Support\Str::limit($prod->description, 80))
                            @else
                                "High quality product with premium craftsmanship",
                                "Fast shipping & easy returns available",
                                "Official warranty covered"
                            @endif
                        ]
                    },
                @endforeach
            @else
                {
                    id: "headphones",
                    slug: "headphones",
                    title: "Studio Pro ANC Headphones",
                    category: "Audio",
                    price: 24999,
                    oldPrice: 34999,
                    rating: 4.9,
                    reviews: 1420,
                    img: "{{ asset('headphones_light_1785685332978.jpg') }}",
                    bullets: ["Hybrid Active Noise Cancellation (45dB)", "Lossless Spatial Surround Audio", "50 Hours Battery Life with Quick Charge"]
                },
                {
                    id: "smartwatch",
                    slug: "smartwatch",
                    title: "Titanium Ultra Smartwatch",
                    category: "Wearables",
                    price: 39999,
                    oldPrice: 49999,
                    rating: 4.85,
                    reviews: 980,
                    img: "{{ asset('smartwatch_light_1785685347961.jpg') }}",
                    bullets: ["Aerospace Grade Titanium Case", "Sapphire Crystal Scratch-Proof Display", "Advanced Continuous Heart & ECG Bio Sensor"]
                },
                {
                    id: "keyboard",
                    slug: "keyboard",
                    title: "Cyberboard RGB Mechanical Keyboard",
                    category: "Gaming",
                    price: 14999,
                    oldPrice: 19999,
                    rating: 4.7,
                    reviews: 650,
                    img: "{{ asset('keyboard_light_1785685361995.jpg') }}",
                    bullets: ["Hot-Swappable Mechanical Switches", "Custom Dynamic RGB Lighting Matrix", "Solid CNC Anodized Aluminum Base"]
                },
                {
                    id: "earbuds",
                    slug: "earbuds",
                    title: "ClearPod Wireless Earbuds",
                    category: "Audio",
                    price: 12999,
                    oldPrice: 17999,
                    rating: 4.6,
                    reviews: 430,
                    img: "{{ asset('earbuds_light_1785685374769.jpg') }}",
                    bullets: ["Transparent Glass Charging Case", "Low Latency Gaming Audio Mode", "IPX5 Water & Sweat Resistance"]
                },
                {
                    id: "gpu",
                    slug: "gpu",
                    title: "GeForce RTX Liquid Cooled GPU",
                    category: "Gaming",
                    price: 74999,
                    oldPrice: 89999,
                    rating: 4.95,
                    reviews: 310,
                    img: "{{ asset('gpu_card_1785685874703.jpg') }}",
                    bullets: ["Flagship Ray Tracing Architecture", "Integrated White Liquid Cooling Block", "24GB High-Speed GDDR6X VRAM"]
                },
                {
                    id: "sofa",
                    slug: "sofa",
                    title: "Curved Bouclé Long Chair",
                    category: "Furniture",
                    price: 39999,
                    oldPrice: 54999,
                    rating: 4.9,
                    reviews: 215,
                    img: "{{ asset('sofa_long_chair_1785685514802.jpg') }}",
                    bullets: ["Textured Soft Cream Bouclé Upholstery", "Sculpted Ergonomic Contour Design", "Solid Scandinavian Oak Legs"]
                }
            @endif
        ];

        let currentCartCount = 0;

        function toggleNav() {
            document.getElementById('dynamicNavbar').classList.toggle('expanded');
        }

        // Close navbar when clicking anywhere outside the nav bar
        document.addEventListener('click', function(e) {
            const navbar = document.getElementById('dynamicNavbar');
            if (navbar && !navbar.contains(e.target) && navbar.classList.contains('expanded')) {
                navbar.classList.remove('expanded');
            }
        });

        // Get Query Parameter
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param) || '';
        }

        function handleLiveSearch(e) {
            if (e.key === 'Enter' || e.type === 'keyup') {
                applyFilters();
            }
        }

        function clearAllFilters() {
            document.querySelectorAll('.filter-sidebar input[type="checkbox"]').forEach(cb => cb.checked = false);
            document.querySelectorAll('.filter-sidebar input[type="radio"]').forEach(rb => rb.checked = false);
            document.getElementById('minPriceInput').value = '';
            document.getElementById('maxPriceInput').value = '';
            document.getElementById('pageSearchInput').value = '';
            document.getElementById('sortSelect').value = 'relevance';
            applyFilters();
        }

        function applyFilters() {
            const pageInputVal = document.getElementById('pageSearchInput').value;
            const searchQuery = (pageInputVal !== '' ? pageInputVal : getQueryParam('q')).toLowerCase().trim();
            document.getElementById('querySpanText').innerText = searchQuery || 'All Products';

            // Selected Categories
            const checkedCats = Array.from(document.querySelectorAll('.filter-sidebar input[type="checkbox"]:checked')).map(cb => cb.value);

            // Minimum Star Rating
            const checkedRating = document.querySelector('.filter-sidebar input[name="starRating"]:checked')?.value || 0;

            // Price Ranges
            const minPrice = parseFloat(document.getElementById('minPriceInput').value) || 0;
            const maxPrice = parseFloat(document.getElementById('maxPriceInput').value) || Infinity;

            // Sort Option
            const sortVal = document.getElementById('sortSelect').value;

            // Filter logic
            let filtered = catalogProducts.filter(item => {
                const matchesQuery = item.title.toLowerCase().includes(searchQuery) || item.category.toLowerCase().includes(searchQuery);
                const matchesCategory = checkedCats.length === 0 || checkedCats.includes(item.category);
                const matchesRating = item.rating >= parseFloat(checkedRating);
                const matchesPrice = item.price >= minPrice && item.price <= maxPrice;

                return matchesQuery && matchesCategory && matchesRating && matchesPrice;
            });

            // Sorting logic
            if (sortVal === 'price-low') {
                filtered.sort((a, b) => a.price - b.price);
            } else if (sortVal === 'price-high') {
                filtered.sort((a, b) => b.price - a.price);
            } else if (sortVal === 'rating') {
                filtered.sort((a, b) => b.rating - a.rating);
            }

            renderProducts(filtered);
        }

        function renderProducts(items) {
            const container = document.getElementById('productsListContainer');
            if (items.length === 0) {
                container.innerHTML = `
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 48px; text-align: center; color: #64748b;">
                        <div style="font-size: 2.5rem; margin-bottom: 12px;">🔍</div>
                        <div style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin-bottom: 6px;">No Matching Products Found</div>
                        <div>Try adjusting your search query or clearing side filter constraints.</div>
                    </div>
                `;
                return;
            }

            container.innerHTML = items.map(item => `
                <div class="product-list-card reveal active" onclick="window.location.href='{{ url('/product') }}/${item.id}'">
                    <div class="list-card-img-box">
                        <img src="${item.img}" alt="${item.title}" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';">
                    </div>

                    <div class="list-card-info">
                        <div class="list-card-title">${item.title}</div>
                        <div class="rating-pill-row">
                            <span class="badge-green-stars">★ ${item.rating}</span>
                            <span class="review-count-text">(${item.reviews.toLocaleString()} Ratings & Reviews)</span>
                        </div>
                        <ul class="list-card-bullets">
                            ${Array.isArray(item.bullets) ? item.bullets.map(b => `<li>${b}</li>`).join('') : `<li>${item.bullets}</li>`}
                        </ul>
                    </div>

                    <div class="list-card-actions-box">
                        <div class="list-price-tag">₹${item.price.toLocaleString('en-IN')}</div>
                        <div class="list-old-price">₹${item.oldPrice.toLocaleString('en-IN')}</div>
                        <div class="free-delivery-badge">✓ Free Express Delivery</div>
                        <button class="btn-view-details" onclick="event.stopPropagation(); window.location.href='{{ url('/product') }}/${item.id}'">View Details</button>
                        <button class="btn-add-cart-list" onclick="event.stopPropagation(); addToCart('${item.title}', ${item.price}, '${item.img}', '${item.id}')">+ Add to Cart</button>
                    </div>
                </div>
            `).join('');
        }

        function addToCart(title, price = 0, imgSrc = '', productId = null) {
            fetch("{{ route('user.cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ title, price, imgSrc, product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                renderCartFromData(data);
                showToast(`Added "${title}" to your cart!`);
            })
            .catch(err => console.error("Error adding to cart:", err));
        }

        function fetchCart() {
            fetch("{{ route('user.cart.get') }}")
            .then(res => res.json())
            .then(data => renderCartFromData(data))
            .catch(err => console.error("Error fetching cart:", err));
        }

        function renderCartFromData(data) {
            const countEl = document.getElementById('cartCount');
            if (countEl) countEl.innerText = data.count || 0;

            const itemsList = document.getElementById('cartItemsList');
            const totalDisplay = document.getElementById('cartTotalDisplay');

            if (itemsList) {
                if (!data.cart || data.cart.length === 0) {
                    itemsList.innerHTML = '<div style="color: #64748b; font-size: 0.8rem; text-align: center; padding: 12px;">Your cart is empty.</div>';
                    if (totalDisplay) totalDisplay.innerText = '₹0.00';
                    return;
                }

                itemsList.innerHTML = '';
                data.cart.forEach((item) => {
                    const img = item.image_path || 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                    const qtyText = item.quantity > 1 ? ` (x${item.quantity})` : '';
                    itemsList.innerHTML += `
                        <div class="cart-item-row" style="display: flex; align-items: center; justify-content: space-between; padding: 8px; border-bottom: 1px solid #f1f5f9;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <img src="${img}" style="width: 28px; height: 28px; border-radius: 6px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';">
                                <div>
                                    <div style="font-weight: 700; color: #0f172a; font-size: 0.82rem;">${item.title}${qtyText}</div>
                                    <div style="color: #2563eb; font-weight: 600; font-size: 0.78rem;">₹${parseFloat(item.price).toLocaleString('en-IN')}</div>
                                </div>
                            </div>
                            <button onclick="removeFromCart(${item.id})" style="background: none; border: none; color: #ef4444; cursor: pointer; font-weight: 700;">✕</button>
                        </div>
                    `;
                });

                if (totalDisplay) totalDisplay.innerText = data.formatted_total || '₹0.00';
            }
        }

        function removeFromCart(cartId) {
            fetch(`{{ url('/cart') }}/${cartId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                renderCartFromData(data);
                showToast("Item removed from cart");
            })
            .catch(err => console.error("Error removing item:", err));
        }

        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchCart();
            const query = getQueryParam('q');
            if (query) {
                document.getElementById('pageSearchInput').value = query;
            }
            applyFilters();
        });
    </script>

    <script>
        /* Page Loader — hide after content is ready */
        window.addEventListener('load', function () {
            setTimeout(function () {
                var loader = document.getElementById('pageLoader');
                if (loader) loader.classList.add('hidden');
            }, 350);
        });
    </script>
</body>
</html>
