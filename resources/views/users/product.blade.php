<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Details — AURA Marketplace</title>
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

        html, body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: #ffffff;
            color: #0f172a;
            overflow-x: hidden !important;
            width: 100%;
            max-width: 100vw;
            touch-action: manipulation;
            -webkit-overflow-scrolling: touch;
        }

        /* Scroll Reveal Animation Styles (Smooth Fade) */
        .reveal {
            opacity: 1;
            transform: none;
            transition: opacity 0.8s ease, transform 0.8s ease;
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
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .cart-btn:hover {
            transform: scale(1.04);
            background: #1e293b;
        }

        .cart-count {
            background: #2563eb;
            color: #ffffff;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 4px;
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
            transition: background 0.2s ease, transform 0.4s ease;
        }

        .expand-toggle:hover {
            background: #e2e8f0;
        }

        .navbar.expanded .expand-toggle {
            transform: rotate(180deg);
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

        .expanded-top-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .search-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 8px 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-grow: 1;
        }

        .search-box svg {
            width: 16px;
            height: 16px;
            fill: #64748b;
        }

        .search-box input {
            background: transparent;
            border: none;
            outline: none;
            color: #0f172a;
            font-size: 0.85rem;
            width: 100%;
        }

        /* Side Nav Sections inside Navbar Drawer */
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
            align-items: center;
        }

        .cart-items-list, .recent-items-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 190px;
            overflow-y: auto;
        }

        .cart-item-row, .recent-drawer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        .recent-drawer-item {
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .recent-drawer-item:hover {
            background: #f1f5f9;
        }

        .cart-checkout-btn {
            width: 100%;
            margin-top: 10px;
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .cart-checkout-btn:hover {
            background: #2563eb;
        }

        /* -------------------------------------------------------------
           FULL PAGE FLIPKART-STYLE UNBOXED PRODUCT CONTAINER
        ------------------------------------------------------------- */
        .page-container {
            max-width: 1760px;
            margin: 0 auto;
            padding: 90px 24px 80px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 24px;
        }

        .breadcrumb a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        /* Top Flipkart 3-Column Widescreen Layout */
        .product-main-layout {
            display: grid;
            grid-template-columns: 500px 1fr 340px;
            gap: 40px;
            margin-bottom: 60px;
        }

        /* Right Delivery & Seller Sidebar Block */
        .delivery-sidebar-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .sidebar-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        }

        .sidebar-card-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .delivery-input-group {
            display: flex;
            gap: 8px;
            margin-bottom: 14px;
        }

        .delivery-input {
            flex: 1;
            padding: 10px 14px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.88rem;
            font-weight: 600;
            outline: none;
        }

        .btn-check-pincode {
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 10px 16px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-check-pincode:hover {
            background: #2563eb;
        }

        .delivery-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 0.88rem;
            color: #334155;
        }

        .delivery-feature-item:last-child {
            margin-bottom: 0;
        }

        .delivery-feature-item .icon {
            font-size: 1.1rem;
        }

        .seller-badge {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            padding: 12px 14px;
            border-radius: 16px;
            margin-top: 10px;
        }

        /* Sticky Gallery Left */
        .gallery-sticky-column {
            position: sticky;
            top: 100px;
            height: fit-content;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .main-hero-img-box {
            width: 100%;
            height: 480px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-hero-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .main-hero-img-box:hover img {
            transform: scale(1.04);
        }

        .thumbnails-row {
            display: flex;
            gap: 12px;
        }

        .thumb-box {
            width: 80px;
            height: 80px;
            border-radius: 14px;
            border: 2px solid #e2e8f0;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .thumb-box.active, .thumb-box:hover {
            border-color: #2563eb;
            transform: translateY(-2px);
        }

        .thumb-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Action Buttons Row under Gallery */
        .cta-buttons-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 8px;
        }

        .btn-buy-now {
            background: #fbbf24;
            color: #0f172a;
            border: none;
            padding: 16px;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
            transition: background 0.2s ease;
        }

        .btn-buy-now:hover {
            background: #f59e0b;
        }

        .btn-add-cart-lg {
            background: #0f172a;
            color: #ffffff;
            border: none;
            padding: 16px;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-add-cart-lg:hover {
            background: #2563eb;
        }

        /* Header blocks toggles */
        .mobile-header-title-block { display: none; }
        .desktop-header-title-block { display: block; }

        .info-full-column { display: flex; flex-direction: column; }
        .product-brand-tag { color: #2563eb; font-weight: 700; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }
        .product-main-title { font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 700; line-height: 1.15; color: #0f172a; margin-bottom: 12px; }
        .ratings-summary-bar { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e2e8f0; }
        .rating-badge-green { background: #16a34a; color: #ffffff; padding: 4px 10px; border-radius: 8px; font-size: 0.88rem; font-weight: 800; display: flex; align-items: center; gap: 4px; }

        @media (max-width: 1440px) {
            .product-main-layout {
                grid-template-columns: 460px 1fr;
            }
            .delivery-sidebar-column {
                display: none;
            }
        }

        .ratings-count-text {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .price-section {
            display: flex;
            align-items: baseline;
            gap: 16px;
            margin-bottom: 24px;
        }

        .current-price {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: #0f172a;
        }

        .original-price {
            font-size: 1.3rem;
            color: #94a3b8;
            text-decoration: line-through;
        }

        .discount-tag {
            color: #16a34a;
            font-size: 1.1rem;
            font-weight: 800;
        }

        /* Highlights & Offers Block */
        .offers-block {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 32px;
        }

        .offers-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .offer-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
            color: #334155;
            margin-bottom: 6px;
        }

        .offer-item span.icon {
            color: #16a34a;
            font-weight: 800;
        }

        .features-highlight-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        /* Detailed Specifications Table (Flipkart Style) */
        .section-heading-lg {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 18px;
        }

        .specs-full-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 48px;
        }

        .specs-full-table tr {
            border-bottom: 1px solid #f1f5f9;
        }

        .specs-full-table td {
            padding: 14px 0;
            font-size: 0.92rem;
        }

        .specs-label-td {
            color: #64748b;
            font-weight: 600;
            width: 220px;
        }

        .specs-val-td {
            color: #0f172a;
            font-weight: 700;
        }

        /* -------------------------------------------------------------
           REVIEWS & RATINGS SECTION
        ------------------------------------------------------------- */
        .reviews-section {
            border-top: 1px solid #e2e8f0;
            padding-top: 48px;
            margin-bottom: 60px;
        }

        .reviews-summary-grid {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 32px;
            margin-bottom: 36px;
            background: #f8fafc;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid #e2e8f0;
        }

        .big-rating-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3.5rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1;
        }

        .rating-breakdown-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
            font-size: 0.85rem;
        }

        .progress-bar-bg {
            flex-grow: 1;
            height: 8px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #16a34a;
        }

        .customer-review-card {
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 0;
        }

        .review-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .reviewer-name {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .review-badge {
            background: #e0f2fe;
            color: #0369a1;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 10px;
        }

        .review-text {
            color: #475569;
            font-size: 0.92rem;
            line-height: 1.6;
        }

        /* -------------------------------------------------------------
           SIMILAR PRODUCTS CAROUSEL/GRID SECTION (SINGLE-ROW HORIZONTAL SLIDER)
        ------------------------------------------------------------- */
        .slider-arrow {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .slider-arrow:hover {
            transform: scale(1.08);
            background: #f1f5f9;
        }

        .slider-arrow.dark {
            background: #0f172a;
            color: #ffffff;
            border: none;
        }

        .slider-arrow.dark:hover {
            background: #2563eb;
        }

        .similar-section {
            border-top: 1px solid #e2e8f0;
            padding-top: 48px;
        }

        .similar-grid {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            gap: 20px;
            padding-bottom: 16px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .similar-grid::-webkit-scrollbar {
            height: 6px;
        }

        .similar-grid::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .similar-grid::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 10px;
        }

        .similar-grid::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }

        .similar-card {
            width: 260px !important;
            min-width: 260px !important;
            max-width: 260px !important;
            flex: 0 0 260px !important;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .similar-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }

        .similar-img-box {
            width: 100%;
            height: 180px;
            border-radius: 16px;
            overflow: hidden;
            background: #f8fafc;
            margin-bottom: 12px;
        }

        .similar-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .similar-title {
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 4px;
            color: #0f172a;
        }

        .similar-price {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: #2563eb;
        }

        /* Mobile & Tablet Responsive Styles */
        @media (max-width: 1024px) {
            .mobile-header-title-block {
                display: block !important;
                margin-bottom: 12px;
            }

            .desktop-header-title-block {
                display: none !important;
            }

            .nav-container {
                top: auto !important;
                bottom: 16px !important;
                padding: 0 12px;
                z-index: 1000;
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

            .drawer-grid {
                grid-template-columns: 1fr;
            }

            .page-container {
                padding: 16px 16px 80px !important;
            }

            .product-main-layout {
                grid-template-columns: 1fr !important;
                gap: 20px;
            }

            .gallery-sticky-column {
                position: relative !important;
                top: 0 !important;
            }

            .main-hero-img-box {
                height: 260px !important;
                max-width: 100% !important;
                border-radius: 20px;
            }

            .main-hero-img-box img {
                max-width: 100% !important;
                max-height: 100% !important;
                object-fit: contain !important;
                padding: 8px;
            }

            .specs-label-td {
                width: 120px !important;
                font-size: 0.85rem !important;
            }

            .specs-val-td {
                font-size: 0.85rem !important;
                word-break: break-word;
            }

            .thumbnails-row {
                justify-content: center;
            }

            .thumb-box {
                width: 64px;
                height: 64px;
                border-radius: 12px;
            }

            /* Action Buttons Row on Mobile */
            .cta-buttons-row {
                position: relative;
                bottom: auto;
                left: auto;
                right: auto;
                z-index: 10;
                background: transparent;
                backdrop-filter: none;
                padding: 0;
                border-radius: 0;
                box-shadow: none;
                border: none;
                margin-top: 16px;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .btn-buy-now, .btn-add-cart-lg {
                padding: 14px;
                font-size: 0.9rem;
                border-radius: 14px;
            }

            .price-section {
                margin-bottom: 16px;
            }

            .current-price {
                font-size: 2.2rem;
            }

            .reviews-summary-grid {
                grid-template-columns: 1fr !important;
                gap: 16px;
                padding: 18px;
            }

            .specs-grid {
                grid-template-columns: 1fr;
            }

            .rating-overview-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .features-highlight-grid {
                grid-template-columns: 1fr;
            }

            .similar-card {
                width: 220px !important;
                min-width: 220px !important;
                max-width: 220px !important;
                flex: 0 0 220px !important;
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
@php
    use Illuminate\Support\Str;

    $productName = $product->name ?? 'Studio Pro ANC Headphones';
    $productDesc = $product->description ?? 'Designed for audiophiles and creators, the AURA Studio Pro delivers lossless acoustic transparency powered by custom engineered dual acoustic drivers.';
    $productPrice = $product->price ?? 24999;
    $productOldPrice = $product->old_price ?? null;
    $sellerName = ($product && $product->seller) ? $product->seller->name : 'AURA Retail India Pvt Ltd';
    $categoryName = ($product && $product->category_id) ? 'Category #'.$product->category_id : 'Audio';

    $imagesList = [];
    if ($product && $product->images && $product->images->count() > 0) {
        foreach ($product->images as $img) {
            $path = $img->image;
            $url = Str::startsWith($path, ['http://', 'https://']) ? $path : asset($path);
            $imagesList[] = $url;
        }
    }

    if (empty($imagesList)) {
        $imagesList = [
            'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80'
        ];
    }

    $mainHeroImg = $imagesList[0];

    // Reviews computation
    $reviewsList = ($product && $product->reviews) ? $product->reviews : collect();
    $totalReviews = $reviewsList->count();
    $avgRating = $totalReviews > 0 ? round($reviewsList->avg('rating'), 1) : 4.9;

    $starCounts = [
        5 => $reviewsList->where('rating', 5)->count(),
        4 => $reviewsList->where('rating', 4)->count(),
        3 => $reviewsList->where('rating', 3)->count(),
        2 => $reviewsList->where('rating', 2)->count(),
        1 => $reviewsList->where('rating', 1)->count(),
    ];
@endphp

    <!-- DYNAMIC ISLAND NAVBAR (PRODUCT PAGE SPECIFIC NAV) -->
    <div class="nav-container">
        <nav class="navbar" id="dynamicNavbar">
            <div class="nav-header">
                <a href="{{ route('user.index') }}" class="nav-left">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('user.index') }}" class="nav-link">← Home</a>
                    <a href="#productMain" class="nav-link active">Overview</a>
                    <a href="#reviewsSection" class="nav-link">Reviews</a>
                    <a href="#similarSection" class="nav-link">Similar</a>
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

            <!-- Expanded Drawer containing Side Nav Sections (Cart & Recently Viewed) -->
            <div class="nav-expanded-content">
                <div class="expanded-top-bar">
                    <div class="search-box">
                        <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                        <form action="{{ route('user.search') }}" method="GET" style="width: 100%; display: flex; align-items: center;">
                            <input type="text" name="q" id="drawerSearchInput" placeholder="Search other items..." style="width: 100%; border: none; background: transparent; outline: none; color: inherit; font-size: inherit;">
                        </form>
                    </div>
                </div>

                <div class="drawer-grid">
                    <!-- Cart Section -->
                    <div class="drawer-section">
                        <div class="drawer-title">
                            <span>YOUR SHOPPING CART</span>
                            <span id="cartTotalDisplay" style="color: #2563eb; font-weight: 700;">$0.00</span>
                        </div>
                        <div class="cart-items-list" id="cartItemsList">
                            <div style="color: #64748b; font-size: 0.8rem; text-align: center; padding: 12px;">Your cart is empty.</div>
                        </div>
                        <button class="cart-checkout-btn" onclick="alert('Proceeding to Checkout!')">Checkout Now</button>
                    </div>

                    <!-- Recently Viewed Items Section -->
                    <div class="drawer-section">
                        <div class="drawer-title">
                            <span>RECENTLY VIEWED</span>
                            <span>🕒 History</span>
                        </div>
                        <div class="recent-items-list" id="recentDrawerList">
                            @if(isset($recentlyViewedProducts) && count($recentlyViewedProducts) > 0)
                                @foreach($recentlyViewedProducts as $rp)
                                    @php
                                        $imgObj = $rp->primaryImage ?? ($rp->images ? $rp->images->first() : null);
                                        $imgPath = $rp->image ?? ($imgObj ? $imgObj->image : null);
                                        if ($imgPath) {
                                            $rpImg = \Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://']) ? $imgPath : asset($imgPath);
                                        } else {
                                            $rpImg = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                                        }
                                    @endphp
                                    <div class="recent-drawer-item"
                                        onclick="window.location.href='{{ url('/product') }}/{{ $rp->id }}'"
                                        style="cursor: pointer;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <img src="{{ $rpImg }}" alt="{{ $rp->name }}" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';"
                                                style="width: 28px; height: 28px; border-radius: 6px; object-fit: cover;">
                                            <span style="font-weight: 600; color: #0f172a; font-size: 0.85rem;">{{ Str::limit($rp->name, 22) }}</span>
                                        </div>
                                        <span style="color: #2563eb; font-weight: 700; font-size: 0.82rem;">₹{{ number_format($rp->price) }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div style="color: #64748b; font-size: 0.8rem; text-align: center; padding: 12px;">No recently viewed items yet.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- MAIN UNBOXED FLIPKART-STYLE PRODUCT PAGE -->
    <main class="page-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('user.index') }}">Home</a> / <span id="breadCat">{{ $categoryName }}</span> / <span id="breadTitle">{{ $productName }}</span>
        </div>

        <!-- 2-COLUMN MAIN PRODUCT LAYOUT -->
        <div class="product-main-layout" id="productMain">
            <!-- STICKY GALLERY LEFT -->
            <div class="gallery-sticky-column">
                <!-- Mobile Header Title Block -->
                <div class="mobile-header-title-block">
                    <div class="product-brand-tag" id="mobileBrandTag" style="color: #2563eb; font-weight: 800; font-size: 0.8rem; letter-spacing: 0.5px; margin-bottom: 4px;">{{ strtoupper($sellerName) }}</div>
                    <h1 class="product-main-title" id="mobilePTitle" style="font-family: 'Space Grotesk', sans-serif; font-size: 1.6rem; font-weight: 700; color: #0f172a; line-height: 1.25; margin-bottom: 8px;">{{ $productName }}</h1>
                    <div class="ratings-summary-bar" style="margin-bottom: 12px; padding-bottom: 12px;">
                        <div class="rating-badge-green">
                            ★ <span id="mobilePRatingNum">{{ $avgRating }}</span>
                        </div>
                        <span class="ratings-count-text">{{ number_format($totalReviews) }} Ratings & Reviews</span>
                    </div>
                </div>

                <div class="main-hero-img-box">
                    <img id="mainDisplayImg" src="{{ $mainHeroImg }}" alt="{{ $productName }}">
                </div>

                <!-- Multiple Product Thumbnails -->
                <div class="thumbnails-row">
                    @foreach($imagesList as $index => $imgUrl)
                        <div class="thumb-box {{ $index === 0 ? 'active' : '' }}" onclick="switchImage('{{ $imgUrl }}', this)">
                            <img src="{{ $imgUrl }}" alt="Product Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>

                <div class="cta-buttons-row">
                    <button class="btn-buy-now" onclick="addToCart('{{ addslashes($productName) }}', {{ $productPrice }}, '{{ addslashes($imagesList[0] ?? '') }}', {{ $product->id ?? 'null' }}); toggleNav();">BUY NOW</button>
                    <button class="btn-add-cart-lg" onclick="addToCart('{{ addslashes($productName) }}', {{ $productPrice }}, '{{ addslashes($imagesList[0] ?? '') }}', {{ $product->id ?? 'null' }})">ADD TO CART</button>
                </div>
            </div>

            <!-- FULL PRODUCT INFO RIGHT -->
            <div class="info-full-column">
                <div class="desktop-header-title-block">
                    <div class="product-brand-tag" id="brandTag">{{ strtoupper($sellerName) }}</div>
                    <h1 class="product-main-title" id="pTitle">{{ $productName }}</h1>

                    <div class="ratings-summary-bar">
                        <div class="rating-badge-green">
                            ★ <span id="pRatingNum">{{ $avgRating }}</span>
                        </div>
                        <span class="ratings-count-text">{{ number_format($totalReviews) }} Ratings & Detailed Reviews</span>
                    </div>
                </div>

                <div class="price-section">
                    <div class="current-price" id="pPrice">₹{{ number_format($productPrice) }}</div>
                    @if(!empty($productOldPrice) && $productOldPrice > $productPrice)
                        <div class="original-price" id="pOldPrice">₹{{ number_format($productOldPrice) }}</div>
                        <div class="discount-tag">{{ round((($productOldPrice - $productPrice) / $productOldPrice) * 100) }}% OFF</div>
                    @endif
                </div>

                <!-- Exclusive Offers Block -->
                <div class="offers-block">
                    <div class="offers-title">Available Offers & Discounts</div>
                    <div class="offer-item"><span class="icon">✔</span> Bank Offer: 10% Instant Discount on HDFC Bank Credit Cards</div>
                    <div class="offer-item"><span class="icon">✔</span> Special Price: Get extra instant discount on checkout</div>
                    <div class="offer-item"><span class="icon">✔</span> Partner Offer: Free 6-month digital subscription pass</div>
                </div>

                <!-- Product Description -->
                <h3 class="section-heading-lg">Product Description</h3>
                <p style="color: #475569; font-size: 1.05rem; line-height: 1.7; margin-bottom: 40px;" id="pDesc">
                    {{ $productDesc }}
                </p>

                <!-- Detailed Specifications Table -->
                <h3 class="section-heading-lg">Technical Specifications</h3>
                <table class="specs-full-table">
                    @if($product && $product->specifications && $product->specifications->count() > 0)
                        @foreach($product->specifications as $spec)
                            <tr>
                                <td class="specs-label-td">{{ $spec->spec_key }}</td>
                                <td class="specs-val-td">{{ $spec->spec_value }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="specs-label-td">Model Name</td>
                            <td class="specs-val-td" id="specModel">{{ $productName }}</td>
                        </tr>
                        <tr>
                            <td class="specs-label-td">SKU Code</td>
                            <td class="specs-val-td">{{ $product->sku ?? 'AUR-'.rand(1000, 9999) }}</td>
                        </tr>
                        <tr>
                            <td class="specs-label-td">Availability</td>
                            <td class="specs-val-td">@if(($product->stock ?? 1) > 0) In Stock ({{ $product->stock ?? 10 }} units) @else Out of stock @endif</td>
                        </tr>
                        <tr>
                            <td class="specs-label-td">Seller</td>
                            <td class="specs-val-td">{{ $sellerName }}</td>
                        </tr>
                    @endif
                </table>
            </div>

            <!-- RIGHT DELIVERY & SELLER SIDEBAR (WIDESCREEN EXPANSION) -->
            <div class="delivery-sidebar-column">
                <div class="sidebar-card">
                    <div class="sidebar-card-title">
                        <span>🚚</span> Delivery Options
                    </div>
                    <div class="delivery-input-group">
                        <input type="text" class="delivery-input" placeholder="Enter Pincode (e.g. 400001)" value="400001">
                        <button class="btn-check-pincode" onclick="showToast('Pincode verified for Express Delivery!')">Check</button>
                    </div>
                    <div class="delivery-feature-item">
                        <span class="icon">⚡</span>
                        <div>
                            <strong style="color: #0f172a;">Express Delivery by Tomorrow</strong>
                            <div style="font-size: 0.78rem; color: #64748b;">Free shipping on orders above ₹499</div>
                        </div>
                    </div>
                    <div class="delivery-feature-item">
                        <span class="icon">💵</span>
                        <div>
                            <strong style="color: #0f172a;">Cash on Delivery Available</strong>
                            <div style="font-size: 0.78rem; color: #64748b;">Pay when item arrives at door</div>
                        </div>
                    </div>
                    <div class="delivery-feature-item">
                        <span class="icon">🔄</span>
                        <div>
                            <strong style="color: #0f172a;">7-Day Replacement Guarantee</strong>
                            <div style="font-size: 0.78rem; color: #64748b;">Hassle-free return policy</div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-card">
                    <div class="sidebar-card-title">
                        <span>🛡️</span> Seller Information
                    </div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $sellerName }}</div>
                    <div style="font-size: 0.8rem; color: #64748b; margin-top: 2px;">Authorized Brand Partner</div>
                    <div class="seller-badge">
                        <span style="font-weight: 800; color: #16a34a; font-size: 0.88rem;">★ 4.8 / 5 Rating</span>
                        <span style="font-size: 0.75rem; color: #64748b; font-weight: 700;">10,000+ Sales</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- REVIEWS AND RATINGS SECTION (FLIPKART STYLE) -->
        <section class="reviews-section" id="reviewsSection">
            <h2 class="section-heading-lg">Ratings & Customer Reviews</h2>

            @if(session('success'))
                <div style="background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 14px; margin-bottom: 24px; font-weight: 600;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="reviews-summary-grid">
                <div>
                    <div class="big-rating-number">{{ $avgRating }} ★</div>
                    <div style="color: #64748b; font-size: 0.9rem; margin-top: 4px;">{{ number_format($totalReviews) }} Verified Buyers</div>
                </div>

                <div>
                    @foreach([5, 4, 3, 2, 1] as $star)
                        @php
                            $c = $starCounts[$star] ?? 0;
                            $pct = $totalReviews > 0 ? round(($c / $totalReviews) * 100) : 0;
                        @endphp
                        <div class="rating-breakdown-bar">
                            <span>{{ $star }} ★</span>
                            <div class="progress-bar-bg"><div class="progress-fill" style="width: {{ $pct }}%;"></div></div>
                            <span>{{ $c }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Individual Customer Reviews List -->
            @forelse($reviewsList as $rev)
                <div class="customer-review-card">
                    <div class="review-header">
                        <div class="rating-badge-green">{{ $rev->rating }} ★</div>
                        <div class="reviewer-name">{{ $rev->user_name }}</div>
                        @if($rev->is_verified)
                            <div class="review-badge">Verified Buyer</div>
                        @endif
                        <span style="font-size: 0.75rem; color: #94a3b8; margin-left: auto;">{{ $rev->created_at ? $rev->created_at->diffForHumans() : 'Recently' }}</span>
                    </div>
                    <div class="review-text">
                        "{{ $rev->comment }}"
                    </div>
                </div>
            @empty
                <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 20px;">No reviews yet. Be the first to leave a review!</p>
            @endforelse

            <!-- Dynamic Write a Review Form -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 24px; margin-top: 36px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);">
                <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.2rem; font-weight: 700; color: #0f172a; margin-bottom: 16px;">✍️ Write a Customer Review</h3>
                <form action="{{ route('user.product.review.store', $product->id ?? 1) }}" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label style="font-size: 0.85rem; font-weight: 600; color: #475569; display: block; margin-bottom: 6px;">Your Name</label>
                            <input type="text" name="user_name" required value="{{ Auth::guard('user')->check() ? Auth::guard('user')->user()->name : '' }}" placeholder="Enter your full name" style="width: 100%; padding: 10px 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; outline: none; font-size: 0.9rem;">
                        </div>
                        <div>
                            <label style="font-size: 0.85rem; font-weight: 600; color: #475569; display: block; margin-bottom: 6px;">Rating</label>
                            <select name="rating" required style="width: 100%; padding: 10px 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; outline: none; font-size: 0.9rem;">
                                <option value="5">5 ★★★★★ (Excellent)</option>
                                <option value="4">4 ★★★★☆ (Good)</option>
                                <option value="3">3 ★★★☆☆ (Average)</option>
                                <option value="2">2 ★★☆☆☆ (Poor)</option>
                                <option value="1">1 ★☆☆☆☆ (Terrible)</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <label style="font-size: 0.85rem; font-weight: 600; color: #475569; display: block; margin-bottom: 6px;">Your Review</label>
                        <textarea name="comment" rows="3" required placeholder="Write your honest review about this product..." style="width: 100%; padding: 10px 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; outline: none; font-size: 0.9rem; resize: vertical;"></textarea>
                    </div>
                    <button type="submit" style="background: #2563eb; color: #ffffff; border: none; padding: 12px 24px; border-radius: 14px; font-weight: 700; font-size: 0.9rem; cursor: pointer; transition: background 0.2s ease;">Submit Review</button>
                </form>
            </div>
        </section>

        <!-- FEATURE BREAKDOWN BANNER CARDS -->
        <section style="border-top: 1px solid #e2e8f0; padding-top: 48px; margin-bottom: 60px;">
            <h2 class="section-heading-lg">Key Features & Highlights</h2>
            <div class="features-highlight-grid">
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 24px; padding: 24px;">
                    <div style="font-size: 1.8rem; margin-bottom: 10px;">🎧</div>
                    <div style="font-weight: 700; font-size: 1.1rem; color: #0f172a; margin-bottom: 6px;">Spatial Acoustic Engine</div>
                    <div style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">Proprietary dual-driver system delivers ultra-clean highs, deep bass response, and 360-degree spatial audio tracking.</div>
                </div>

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 24px; padding: 24px;">
                    <div style="font-size: 1.8rem; margin-bottom: 10px;">⚡</div>
                    <div style="font-weight: 700; font-size: 1.1rem; color: #0f172a; margin-bottom: 6px;">Rapid Charge Technology</div>
                    <div style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">10 minutes of USB-C fast charging provides up to 5 full hours of uninterrupted high-fidelity playback.</div>
                </div>

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 24px; padding: 24px;">
                    <div style="font-size: 1.8rem; margin-bottom: 10px;">🛡️</div>
                    <div style="font-weight: 700; font-size: 1.1rem; color: #0f172a; margin-bottom: 6px;">Ergonomic Comfort</div>
                    <div style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">Ultra-soft breathable memory foam ear cushions engineered for zero-fatigue listening during extended working sessions.</div>
                </div>
            </div>
        </section>

        <!-- QUESTIONS & ANSWERS (FAQ) SECTION -->
        <section style="border-top: 1px solid #e2e8f0; padding-top: 48px; margin-bottom: 60px;">
            <h2 class="section-heading-lg">Questions & Answers</h2>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                @if($product && $product->faqs && $product->faqs->count() > 0)
                    @foreach($product->faqs as $faq)
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 20px;">
                            <div style="font-weight: 700; font-size: 0.98rem; color: #0f172a; margin-bottom: 6px;">Q: {{ $faq->question }}</div>
                            <div style="font-size: 0.9rem; color: #475569; line-height: 1.5;">A: {{ $faq->answer }}</div>
                        </div>
                    @endforeach
                @else
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 20px;">
                        <div style="font-weight: 700; font-size: 0.98rem; color: #0f172a; margin-bottom: 6px;">Q: Does this product support multi-device dual pairing?</div>
                        <div style="font-size: 0.9rem; color: #475569; line-height: 1.5;">A: Yes, it features Bluetooth 5.3 Multipoint technology allowing seamless auto-switching between your laptop and smartphone.</div>
                    </div>
                @endif
            </div>
        </section>

        <!-- SIMILAR PRODUCTS CAROUSEL SECTION -->
        <section class="similar-section" id="similarSection" style="margin-bottom: 80px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 class="section-heading-lg" style="margin-bottom: 0;">Similar Products You Might Like</h2>
                <div style="display: flex; gap: 8px;">
                    <button class="slider-arrow" onclick="scrollSimilarGrid(-300)" aria-label="Scroll left">←</button>
                    <button class="slider-arrow dark" onclick="scrollSimilarGrid(300)" aria-label="Scroll right">→</button>
                </div>
            </div>

            <div class="similar-grid" id="similarProductsGrid">
                @if(isset($similarProducts) && $similarProducts->count() > 0)
                    @foreach($similarProducts as $sim)
                        @php
                            $simImgObj = $sim->primaryImage ?? ($sim->images ? $sim->images->first() : null);
                            $simImgPath = $simImgObj ? $simImgObj->image : 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                            $simImgUrl = Str::startsWith($simImgPath, ['http://', 'https://']) ? $simImgPath : asset($simImgPath);
                        @endphp
                        <div class="similar-card" onclick="window.location.href='{{ route('user.product.show', $sim->id) }}'">
                            <div class="similar-img-box">
                                <img src="{{ $simImgUrl }}" alt="{{ $sim->name }}" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';">
                            </div>
                            <div class="similar-title">{{ $sim->name }}</div>
                            <div class="similar-price">₹{{ number_format($sim->price) }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="similar-card" onclick="window.location.href='{{ route('user.product.show') }}'">
                        <div class="similar-img-box">
                            <img src="{{ asset('headphones_light_1785685332978.jpg') }}">
                        </div>
                        <div class="similar-title">Studio Pro ANC Headphones</div>
                        <div class="similar-price">₹24,999</div>
                    </div>
                @endif
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
                    <li><a href="{{ route('user.index') }}">Flash Deals</a></li>
                    <li><a href="{{ route('user.index') }}">Audio & Tech</a></li>
                    <li><a href="{{ route('user.index') }}">Luxury Furniture</a></li>
                    <li><a href="{{ route('user.index') }}">Gaming Gear</a></li>
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
        function switchImage(src, element) {
            document.getElementById('mainDisplayImg').src = src;
            document.querySelectorAll('.thumb-box').forEach(t => t.classList.remove('active'));
            element.classList.add('active');
        }

        function toggleNav() {
            const navbar = document.getElementById('dynamicNavbar');
            navbar.classList.toggle('expanded');
        }

        function scrollSimilarGrid(amount) {
            const grid = document.getElementById('similarProductsGrid');
            if (grid) {
                grid.scrollBy({ left: amount, behavior: 'smooth' });
            }
        }

        // Close navbar ONLY when clicking outside the nav bar
        document.addEventListener('click', function(e) {
            const navbar = document.getElementById('dynamicNavbar');
            if (navbar && !navbar.contains(e.target) && navbar.classList.contains('expanded')) {
                navbar.classList.remove('expanded');
            }
        });

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

        function addToCart(title, price, imgSrc, productId = null) {
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

        document.addEventListener('DOMContentLoaded', () => {
            fetchCart();
            const revealElements = document.querySelectorAll('.product-main-layout, .reviews-section, section, .similar-card, footer');
            revealElements.forEach(el => {
                el.classList.add('reveal');
                revealObserver.observe(el);
            });
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
