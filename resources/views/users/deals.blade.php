<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot Deals & Special Offers — AURA Marketplace</title>
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

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(40px) scale(0.96);
            transition: opacity 1.4s cubic-bezier(0.16, 1, 0.3, 1), transform 1.4s cubic-bezier(0.16, 1, 0.3, 1);
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
            width: 750px;
            padding: 8px 16px;
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

        .nav-link:hover, .nav-link.active {
            color: #2563eb;
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
        }

        /* Expanded Dynamic Island Drawer */
        .nav-expanded-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
        }

        .navbar.expanded {
            width: 800px;
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

        .drawer-title {
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }

        /* -------------------------------------------------------------
           DEALS PAGE HERO & CATALOG
        ------------------------------------------------------------- */
        .page-wrapper {
            max-width: 1760px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        .deals-hero-banner {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            border-radius: 36px;
            padding: 48px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1);
        }

        .deals-banner-badge {
            background: #ef4444;
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 6px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 14px;
        }

        .deals-hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3.2rem;
            font-weight: 700;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .deals-hero-desc {
            font-size: 1.05rem;
            color: #94a3b8;
            max-width: 550px;
            line-height: 1.6;
        }

        .deals-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .deal-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 28px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            cursor: pointer;
        }

        .deal-card:hover {
            transform: translateY(-6px);
            border-color: #cbd5e1;
            box-shadow: 0 20px 30px rgba(15, 23, 42, 0.08);
        }

        .deal-tag-save {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #16a34a;
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 6px 12px;
            border-radius: 20px;
            z-index: 2;
        }

        .deal-img-box {
            width: 100%;
            height: 240px;
            background: #f8fafc;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .deal-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .deal-card:hover .deal-img-box img {
            transform: scale(1.08);
        }

        .deal-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .deal-desc {
            font-size: 0.88rem;
            color: #64748b;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .deal-prices-row {
            display: flex;
            align-items: baseline;
            gap: 12px;
        }

        .deal-price-current {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
        }

        .deal-price-old {
            font-size: 0.95rem;
            color: #94a3b8;
            text-decoration: line-through;
        }

        .btn-claim-deal {
            width: 100%;
            margin-top: 14px;
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-claim-deal:hover {
            background: #2563eb;
        }

        /* Toast */
        .toast {
            position: fixed;
            top: 24px;
            right: 20px;
            bottom: auto;
            background: #0f172a;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 14px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 2500;
            transform: translateY(-40px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        @media (max-width: 1024px) {
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

            .nav-links {
                display: none;
            }

            .page-wrapper {
                padding: 24px 16px 100px !important;
            }

            .deals-hero-banner {
                padding: 28px 20px;
                border-radius: 24px;
            }

            .deals-hero-title {
                font-size: 2rem;
            }

            .deals-grid {
                grid-template-columns: 1fr;
            }
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
        @media (max-width: 1024px) { .footer-container { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 640px) { .footer-container { grid-template-columns: 1fr; } .footer-bottom { flex-direction: column; gap: 12px; text-align: center; } }

        /* Toast Position */
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
                <a href="index.blade.php" class="nav-left">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                </a>

                <div class="nav-links">
                    <a href="index.blade.php" class="nav-link">← Home</a>
                    <a href="deals.blade.php" class="nav-link active">Deals & Offers</a>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <!-- User Profile Dropdown Icon -->
                    <div class="profile-dropdown-wrapper">
                        <button class="profile-icon-btn" aria-label="User Account" onclick="toggleNav();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </button>
                        <div class="profile-menu">
                            <div class="profile-menu-header">
                                <div class="user-name">Welcome Guest</div>
                                <div class="user-desc">Manage orders & account settings</div>
                            </div>
                            <button class="btn-profile-login" onclick="showToast('Redirecting to Login Page...')">
                                🔑 Login / Sign Up
                            </button>
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

            <!-- Expanded Drawer -->
            <div class="nav-expanded-content">
                <div class="drawer-grid" style="padding-top: 14px;">
                    <div class="drawer-section">
                        <div class="drawer-title">
                            <span>SHOPPING CART</span>
                            <span id="cartTotalDisplay" style="color: #2563eb; font-weight: 700;">₹0.00</span>
                        </div>
                        <div id="cartItemsList" style="font-size: 0.8rem; color: #64748b; padding: 10px;">Cart is empty</div>
                    </div>
                    <div class="drawer-section">
                        <div class="drawer-title"><span>QUICK LINKS</span></div>
                        <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.85rem;">
                            <a href="index.blade.php" style="color: #2563eb; text-decoration: none; font-weight: 600;">Main Store Catalog</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- MAIN DEALS PAGE CONTENT -->
    <main class="page-wrapper">
        <!-- Hero Banner -->
        <div class="deals-hero-banner">
            <span class="deals-banner-badge">🔥 LIMITED TIME PROMO</span>
            <h1 class="deals-hero-title" id="dealCategoryTitle">Special Flash Deals</h1>
            <p class="deals-hero-desc" id="dealCategoryDesc">
                Exclusive discounts up to 50% off on flagship ANC headphones, high-performance liquid-cooled GPUs, and luxury bouclé chairs.
            </p>
        </div>

        <!-- Category Deals Navigation Bar -->
        <div class="deals-cat-bar" style="display: flex; gap: 10px; overflow-x: auto; padding-bottom: 12px; margin-bottom: 28px; scrollbar-width: none;">
            <button class="deal-chip active" onclick="filterDealCat('all', this)" style="background: #0f172a; color: #ffffff; border: none; border-radius: 20px; padding: 8px 18px; font-size: 0.85rem; font-weight: 700; cursor: pointer; white-space: nowrap;">⚡ All Flash Deals</button>
            <button class="deal-chip" onclick="filterDealCat('audio', this)" style="background: #ffffff; color: #475569; border: 1px solid #e2e8f0; border-radius: 20px; padding: 8px 18px; font-size: 0.85rem; font-weight: 600; cursor: pointer; white-space: nowrap;">🎧 Audio & Electronics</button>
            <button class="deal-chip" onclick="filterDealCat('gaming', this)" style="background: #ffffff; color: #475569; border: 1px solid #e2e8f0; border-radius: 20px; padding: 8px 18px; font-size: 0.85rem; font-weight: 600; cursor: pointer; white-space: nowrap;">🎮 Gaming PC Parts</button>
            <button class="deal-chip" onclick="filterDealCat('wearables', this)" style="background: #ffffff; color: #475569; border: 1px solid #e2e8f0; border-radius: 20px; padding: 8px 18px; font-size: 0.85rem; font-weight: 600; cursor: pointer; white-space: nowrap;">⌚ Smart Wearables</button>
            <button class="deal-chip" onclick="filterDealCat('furniture', this)" style="background: #ffffff; color: #475569; border: 1px solid #e2e8f0; border-radius: 20px; padding: 8px 18px; font-size: 0.85rem; font-weight: 600; cursor: pointer; white-space: nowrap;">🛋️ Scandinavian Furniture</button>
        </div>

        <!-- Deals Grid -->
        <div class="deals-grid" id="dealsGrid">
            <!-- Deal 1 -->
            <div class="deal-card reveal" data-dealcat="audio" onclick="window.location.href='product.blade.php?id=headphones'">
                <span class="deal-tag-save">50% OFF</span>
                <div class="deal-img-box">
                    <img src="headphones_light_1785685332978.jpg">
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="background: #16a34a; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">4.9 ★</span>
                    <span style="color: #64748b; font-size: 0.78rem;">(1,420 Ratings)</span>
                </div>
                <div class="deal-title">Studio Pro ANC Headphones</div>
                <div class="deal-desc">Lossless acoustic transparency with 50-hour battery life and hybrid active noise cancellation.</div>
                <div style="font-size: 0.78rem; color: #16a34a; font-weight: 700; margin-bottom: 8px;">✔ Free Express Delivery by Tomorrow</div>
                <div class="deal-prices-row">
                    <span class="deal-price-current">₹24,999</span>
                    <span class="deal-price-old">₹34,999</span>
                </div>
                <button class="btn-claim-deal" onclick="event.stopPropagation(); addToCart('Studio Pro ANC Headphones', 24999, 'headphones_light_1785685332978.jpg')">⚡ Claim Deal</button>
            </div>

            <!-- Deal 2 -->
            <div class="deal-card reveal" data-dealcat="gaming" onclick="window.location.href='product.blade.php?id=gpu'">
                <span class="deal-tag-save">SAVE ₹15,000</span>
                <div class="deal-img-box">
                    <img src="gpu_card_1785685874703.jpg">
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="background: #16a34a; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">4.95 ★</span>
                    <span style="color: #64748b; font-size: 0.78rem;">(980 Ratings)</span>
                </div>
                <div class="deal-title">GeForce RTX Liquid Cooled GPU</div>
                <div class="deal-desc">Flagship ray tracing graphics architecture with sleek white liquid cooling block.</div>
                <div style="font-size: 0.78rem; color: #16a34a; font-weight: 700; margin-bottom: 8px;">✔ Free Express Delivery & Bank Discount</div>
                <div class="deal-prices-row">
                    <span class="deal-price-current">₹74,999</span>
                    <span class="deal-price-old">₹89,999</span>
                </div>
                <button class="btn-claim-deal" onclick="event.stopPropagation(); addToCart('GeForce RTX GPU', 74999, 'gpu_card_1785685874703.jpg')">⚡ Claim Deal</button>
            </div>

            <!-- Deal 3 -->
            <div class="deal-card reveal" data-dealcat="furniture" onclick="window.location.href='product.blade.php?id=sofa'">
                <span class="deal-tag-save">HOT PICK 30% OFF</span>
                <div class="deal-img-box">
                    <img src="sofa_long_chair_1785685514802.jpg">
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="background: #16a34a; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">4.9 ★</span>
                    <span style="color: #64748b; font-size: 0.78rem;">(640 Ratings)</span>
                </div>
                <div class="deal-title">Curved Bouclé Long Chair</div>
                <div class="deal-desc">Sculpted modern lounge seating crafted with tactile cream bouclé fabric & solid oak legs.</div>
                <div style="font-size: 0.78rem; color: #16a34a; font-weight: 700; margin-bottom: 8px;">✔ Free Home Installation</div>
                <div class="deal-prices-row">
                    <span class="deal-price-current">₹39,999</span>
                    <span class="deal-price-old">₹54,999</span>
                </div>
                <button class="btn-claim-deal" onclick="event.stopPropagation(); addToCart('Long Bouclé Chair', 39999, 'sofa_long_chair_1785685514802.jpg')">⚡ Claim Deal</button>
            </div>

            <!-- Deal 4 -->
            <div class="deal-card reveal" data-dealcat="wearables" onclick="window.location.href='product.blade.php?id=smartwatch'">
                <span class="deal-tag-save">SAVE ₹10,000</span>
                <div class="deal-img-box">
                    <img src="smartwatch_light_1785685347961.jpg">
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="background: #16a34a; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">4.85 ★</span>
                    <span style="color: #64748b; font-size: 0.78rem;">(2,100 Ratings)</span>
                </div>
                <div class="deal-title">Titanium Ultra Smartwatch</div>
                <div class="deal-desc">Aerospace titanium casing with scratch-resistant sapphire glass display & bio tracking sensors.</div>
                <div style="font-size: 0.78rem; color: #16a34a; font-weight: 700; margin-bottom: 8px;">✔ Free Screen Guard Included</div>
                <div class="deal-prices-row">
                    <span class="deal-price-current">₹39,999</span>
                    <span class="deal-price-old">₹49,999</span>
                </div>
                <button class="btn-claim-deal" onclick="event.stopPropagation(); addToCart('Titanium Ultra Smartwatch', 39999, 'smartwatch_light_1785685347961.jpg')">⚡ Claim Deal</button>
            </div>

            <!-- Deal 5 -->
            <div class="deal-card reveal" data-dealcat="gaming" onclick="window.location.href='product.blade.php?id=keyboard'">
                <span class="deal-tag-save">25% OFF</span>
                <div class="deal-img-box">
                    <img src="keyboard_light_1785685361995.jpg">
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="background: #16a34a; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">4.8 ★</span>
                    <span style="color: #64748b; font-size: 0.78rem;">(820 Ratings)</span>
                </div>
                <div class="deal-title">Cyberboard RGB Mechanical Keyboard</div>
                <div class="deal-desc">Hot-swappable mechanical key switches with custom per-key RGB backlight illumination profiles.</div>
                <div style="font-size: 0.78rem; color: #16a34a; font-weight: 700; margin-bottom: 8px;">✔ Includes Coiled Cable</div>
                <div class="deal-prices-row">
                    <span class="deal-price-current">₹14,999</span>
                    <span class="deal-price-old">₹19,999</span>
                </div>
                <button class="btn-claim-deal" onclick="event.stopPropagation(); addToCart('Cyberboard Keyboard', 14999, 'keyboard_light_1785685361995.jpg')">⚡ Claim Deal</button>
            </div>

            <!-- Deal 6 -->
            <div class="deal-card reveal" data-dealcat="audio" onclick="window.location.href='product.blade.php?id=earbuds'">
                <span class="deal-tag-save">FLASHSALE 30%</span>
                <div class="deal-img-box">
                    <img src="earbuds_light_1785685374769.jpg">
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="background: #16a34a; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">4.8 ★</span>
                    <span style="color: #64748b; font-size: 0.78rem;">(1,150 Ratings)</span>
                </div>
                <div class="deal-title">ClearPod Wireless Earbuds</div>
                <div class="deal-desc">Transparent aesthetic charging case with high-fidelity spatial surround audio and ANC.</div>
                <div style="font-size: 0.78rem; color: #16a34a; font-weight: 700; margin-bottom: 8px;">✔ Free Express Delivery</div>
                <div class="deal-prices-row">
                    <span class="deal-price-current">₹12,999</span>
                    <span class="deal-price-old">₹17,999</span>
                </div>
                <button class="btn-claim-deal" onclick="event.stopPropagation(); addToCart('ClearPod Wireless Earbuds', 12999, 'earbuds_light_1785685374769.jpg')">⚡ Claim Deal</button>
            </div>

            <!-- Deal 7 -->
            <div class="deal-card reveal" data-dealcat="furniture" onclick="window.location.href='product.blade.php?id=armchair'">
                <span class="deal-tag-save">SAVE ₹10,000</span>
                <div class="deal-img-box">
                    <img src="armchair_white_1785685529905.jpg">
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="background: #16a34a; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">4.75 ★</span>
                    <span style="color: #64748b; font-size: 0.78rem;">(430 Ratings)</span>
                </div>
                <div class="deal-title">Nordic Cream Armchair</div>
                <div class="deal-desc">Minimalist Scandinavian arm chair featuring sculpted wooden armrests & stain-resistant fabric.</div>
                <div style="font-size: 0.78rem; color: #16a34a; font-weight: 700; margin-bottom: 8px;">✔ Free Assembly Included</div>
                <div class="deal-prices-row">
                    <span class="deal-price-current">₹32,999</span>
                    <span class="deal-price-old">₹42,999</span>
                </div>
                <button class="btn-claim-deal" onclick="event.stopPropagation(); addToCart('Nordic Cream Armchair', 32999, 'armchair_white_1785685529905.jpg')">⚡ Claim Deal</button>
            </div>

            <!-- Deal 8 -->
            <div class="deal-card reveal" data-dealcat="furniture" onclick="window.location.href='product.blade.php?id=table'">
                <span class="deal-tag-save">25% OFF</span>
                <div class="deal-img-box">
                    <img src="nest_table_1785685562313.jpg">
                </div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="background: #16a34a; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">4.85 ★</span>
                    <span style="color: #64748b; font-size: 0.78rem;">(310 Ratings)</span>
                </div>
                <div class="deal-title">Organic Nest Coffee Table</div>
                <div class="deal-desc">Organic shaped natural wood centerpiece table with a smooth matte protective lacquer finish.</div>
                <div style="font-size: 0.78rem; color: #16a34a; font-weight: 700; margin-bottom: 8px;">✔ Free Express Shipping</div>
                <div class="deal-prices-row">
                    <span class="deal-price-current">₹22,999</span>
                    <span class="deal-price-old">₹29,999</span>
                </div>
                <button class="btn-claim-deal" onclick="event.stopPropagation(); addToCart('Organic Nest Coffee Table', 22999, 'nest_table_1785685562313.jpg')">⚡ Claim Deal</button>
            </div>
        </div>
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

    <!-- Toast -->
    <div class="toast" id="toast">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="#38bdf8"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        <span id="toastMsg">Item added to cart!</span>
    </div>

    <script>
        let cart = [];

        function toggleNav() {
            const navbar = document.getElementById('dynamicNavbar');
            navbar.classList.toggle('expanded');
        }

        function filterDealCat(cat, btn) {
            document.querySelectorAll('.deal-chip').forEach(b => {
                b.style.background = '#ffffff';
                b.style.color = '#475569';
                b.style.border = '1px solid #e2e8f0';
            });
            btn.style.background = '#0f172a';
            btn.style.color = '#ffffff';
            btn.style.border = 'none';

            const cards = document.querySelectorAll('.deal-card');
            cards.forEach(card => {
                const cardCat = card.dataset.dealcat || '';
                if (cat === 'all' || cardCat === cat) {
                    card.style.display = 'flex';
                }
            });
        }

        document.addEventListener('click', function(e) {
            const navbar = document.getElementById('dynamicNavbar');
            if (navbar && !navbar.contains(e.target) && navbar.classList.contains('expanded')) {
                navbar.classList.remove('expanded');
            }
        });

        function addToCart(title, price, imgSrc) {
            cart.push({ title, price, imgSrc });
            document.getElementById('cartCount').innerText = cart.length;
            showToast(`Claimed deal for "${title}"!`);
        }

        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        // Scroll Reveal Observer
        const observerOptions = { threshold: 0.12 };
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
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
