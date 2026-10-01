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
            background: #f1f5f9;
            color: #0f172a;
            overflow-x: hidden;
            width: 100%;
        }

        /* Scroll Reveal Animation Styles */
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
           DYNAMIC ISLAND NAVBAR (CLEAN WHITE THEME)
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
            width: 660px;
            padding: 8px 14px;
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

        .nav-link:hover,
        .nav-link.active {
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

        .profile-dropdown-wrapper:hover .profile-icon-btn,
        .profile-icon-btn:hover {
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

        .cart-items-list,
        .recent-items-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 190px;
            overflow-y: auto;
        }

        .cart-item-row,
        .recent-drawer-item {
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
           PAGE WRAPPER & EXTENDED CATALOG GRID
        ------------------------------------------------------------- */
        .page-wrapper {
            width: 100%;
            max-width: 1760px;
            margin: 0 auto;
            padding: 100px 32px 60px;
        }

        .category-nav-bar {
            display: flex;
            justify-content: flex-start;
            gap: 12px;
            margin-bottom: 28px;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 4px;
        }

        .cat-chip {
            background: #ffffff;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 30px;
            padding: 10px 24px;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            white-space: nowrap;
        }

        .cat-chip.active {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
            box-shadow: 0 8px 16px rgba(15, 23, 42, 0.12);
        }

        .cat-chip:hover:not(.active) {
            background: #e2e8f0;
            color: #0f172a;
        }

        /* Bento Hero Layout */
        .bento-grid {
            display: grid;
            grid-template-columns: 400px 1.2fr 300px;
            gap: 24px;
            margin-bottom: 48px;
        }

        /* COLUMN 1: NEW DEALS HERO CARD */
        .card-new-deals {
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
            border-radius: 32px;
            padding: 28px;
            position: relative;
            min-height: 560px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            border: 1px solid #ffffff;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.05);
        }

        .deals-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 2;
        }

        .deals-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.6rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -1px;
        }

        .deals-badge {
            background: #0f172a;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .floating-product-card {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 22px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.9);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .floating-product-card.auto-anim-flip {
            animation: cardSlideReplace 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes cardSlideReplace {
            0% {
                opacity: 0;
                transform: translateX(60px) scale(0.96);
            }

            100% {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        /* Great Value Deals Horizontal Card Slide Replacement */
        .card-value-deals .value-deal-content-wrap {
            transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-value-deals .hero-center-img {
            transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-value-deals.auto-anim-zoom .value-deal-content-wrap {
            animation: slideTextReplace 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .card-value-deals.auto-anim-zoom .hero-center-img {
            animation: slideImageReplace 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideTextReplace {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideImageReplace {
            0% {
                opacity: 0;
                transform: translateX(70px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Exclusive Release Fade Left Animation */
        .card-exclusive-info.auto-anim-glow .card-exclusive-bg-img {
            animation: bgFadeLeft 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .card-exclusive-info.auto-anim-glow .card-exclusive-content {
            animation: contentFadeLeft 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes bgFadeLeft {
            0% {
                opacity: 0;
                transform: translateX(45px) scale(1.05);
            }

            100% {
                opacity: 0.35;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes contentFadeLeft {
            0% {
                opacity: 0;
                transform: translateX(40px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .floating-product-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 30px 50px rgba(15, 23, 42, 0.12);
        }

        .floating-product-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .product-price-tag {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.9rem;
            font-weight: 700;
            color: #0f172a;
        }

        .product-sub-name {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
        }

        .rating-badge {
            background: #ffffff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            color: #0f172a;
        }

        .product-preview-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 18px;
            margin-bottom: 14px;
            transition: transform 0.5s ease;
        }

        .floating-product-card:hover .product-preview-img {
            transform: scale(1.05);
        }

        .floating-card-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .action-circle-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .action-circle-btn:hover {
            transform: scale(1.1);
            background: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
        }

        .slider-controls {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 8px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.84rem;
            font-weight: 600;
            color: #334155;
            margin-top: 16px;
        }

        .slider-arrow {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: 700;
            transition: transform 0.2s ease;
        }

        .slider-arrow.dark {
            background: #0f172a;
            color: #ffffff;
        }

        /* COLUMN 2: CENTER STACK */
        .column-center {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .card-value-deals {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 32px;
            padding: 32px;
            height: 320px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
        }

        .card-value-deals:hover {
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            transform: translateY(-2px);
        }

        .value-deals-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.3rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .value-deals-sub {
            font-size: 0.9rem;
            color: #64748b;
            margin-top: 4px;
            font-weight: 500;
        }

        .card-value-deals img.hero-center-img {
            position: absolute;
            right: 20px;
            bottom: -10px;
            height: 260px;
            width: 260px;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .card-value-deals:hover img.hero-center-img {
            transform: scale(1.06) rotate(-2deg);
        }

        .center-bottom-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            height: 220px;
        }

        .card-exclusive-info {
            background: #0f172a;
            border: 1px solid #e2e8f0;
            border-radius: 32px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            position: relative;
            overflow: hidden;
            color: #ffffff;
        }

        .card-exclusive-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.35;
            z-index: 1;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .card-exclusive-info:hover .card-exclusive-bg-img {
            transform: scale(1.08);
            opacity: 0.45;
        }

        .card-exclusive-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .pill-tag {
            align-self: flex-start;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            color: #0f172a;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .exclusive-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .exclusive-desc {
            font-size: 0.82rem;
            color: #64748b;
            line-height: 1.4;
        }

        .card-focus-chair {
            background: #e2e8f0;
            border-radius: 32px;
            position: relative;
            overflow: hidden;
            padding: 12px;
            border: 1px solid #e2e8f0;
        }

        .card-focus-chair img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 22px;
            transition: transform 0.5s ease;
        }

        .heart-float-btn {
            position: absolute;
            top: 24px;
            right: 24px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        .open-pill-btn {
            position: absolute;
            bottom: 24px;
            right: 24px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border-radius: 30px;
            padding: 6px 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            color: #0f172a;
            cursor: pointer;
        }

        .open-arrow-black {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #0f172a;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        /* COLUMN 3: RIGHT WIDGETS */
        .column-right {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .widget-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 32px;
            padding: 24px;
            position: relative;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
        }

        .widget-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .widget-tag {
            background: #f1f5f9;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
        }

        .arrow-corner-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0f172a;
            border: none;
            cursor: pointer;
            font-weight: 700;
        }

        .subscribe-input {
            width: 100%;
            padding: 12px 18px;
            border-radius: 30px;
            border: 1px solid #e2e8f0;
            font-size: 0.85rem;
            margin-bottom: 10px;
            outline: none;
            background: #f8fafc;
        }

        .subscribe-btn {
            width: 100%;
            padding: 12px;
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .subscribe-btn:hover {
            background: #2563eb;
        }

        /* -------------------------------------------------------------
           NEW EXTENDED STORE PRODUCTS CATALOG GRID (MANY MORE ITEMS)
        ------------------------------------------------------------- */
        .catalog-section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        /* Horizontal Single-Row Scroll Mode for "All" Selection */
        .catalog-grid.scroll-mode {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            gap: 20px;
            padding-bottom: 12px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /* Custom Modern Scrollbar */
        .catalog-grid.scroll-mode::-webkit-scrollbar {
            height: 6px;
        }

        .catalog-grid.scroll-mode::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .catalog-grid.scroll-mode::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 10px;
        }

        .catalog-grid.scroll-mode::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }

        .catalog-grid.scroll-mode .catalog-card {
            width: 280px !important;
            min-width: 280px !important;
            max-width: 280px !important;
            flex: 0 0 280px !important;
        }

        .catalog-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 28px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            position: relative;
        }

        .catalog-card:hover {
            transform: translateY(-6px);
            border-color: #cbd5e1;
            box-shadow: 0 20px 30px rgba(15, 23, 42, 0.08);
        }

        .catalog-img-box {
            width: 100%;
            height: 200px;
            border-radius: 20px;
            overflow: hidden;
            background: #f8fafc;
            margin-bottom: 14px;
            position: relative;
        }

        .catalog-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .catalog-card:hover .catalog-img-box img {
            transform: scale(1.08);
        }

        .badge-cat {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            color: #1e40af;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
        }

        .catalog-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .catalog-desc {
            font-size: 0.84rem;
            color: #64748b;
            line-height: 1.4;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .catalog-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
        }

        .catalog-price {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #0f172a;
        }

        .add-cart-btn {
            background: #f1f5f9;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 8px 16px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-cart-btn:hover {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        /* Toast Notification */
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

        /* Medium Tablet & Small Laptop Responsive Styles (@media max-width: 1200px) */
        @media (max-width: 1200px) {
            .navbar {
                width: 100% !important;
                max-width: 660px;
            }

            .bento-grid {
                grid-template-columns: 1fr 1fr;
                gap: 20px;
            }

            .column-right {
                grid-column: span 2;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
            }

            .card-value-deals>div:first-child {
                max-width: 65% !important;
            }

            .hero-center-img,
            .card-value-deals img.hero-center-img {
                width: 220px !important;
                height: 220px !important;
            }
        }

        /* Mobile Responsive Styles (@media max-width: 900px) */
        @media (max-width: 900px) {
            .nav-container {
                top: auto !important;
                bottom: 16px !important;
                padding: 0 12px;
            }

            .navbar {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 28px;
                padding: 8px 14px;
                box-shadow: 0 -10px 30px rgba(15, 23, 42, 0.15), 0 0 0 1px rgba(15, 23, 42, 0.08);
            }

            .navbar.expanded {
                width: 100% !important;
                border-radius: 28px;
            }

            .nav-links {
                display: none;
            }

            .drawer-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .page-wrapper {
                padding: 24px 16px 120px !important;
                /* Bottom padding so content is not hidden behind bottom navbar */
            }

            .category-nav-bar {
                gap: 8px;
                padding-bottom: 8px;
                margin-bottom: 24px;
            }

            .cat-chip {
                padding: 8px 14px;
                font-size: 0.82rem;
                white-space: nowrap;
            }

            .bento-grid {
                grid-template-columns: 1fr;
                gap: 24px !important;
            }

            .column-right {
                grid-column: span 1;
                display: flex;
                flex-direction: column;
                gap: 24px !important;
            }

            .card-new-deals {
                padding: 20px;
                min-height: auto;
            }

            .floating-product-card {
                padding: 14px;
            }

            .column-center {
                gap: 24px !important;
            }

            .card-value-deals {
                padding: 20px;
                flex-direction: column;
                height: auto !important;
                min-height: auto !important;
                overflow: hidden;
            }

            .card-value-deals>div:first-child {
                max-width: 100% !important;
            }

            .hero-center-img,
            .card-value-deals img.hero-center-img {
                position: relative !important;
                right: auto !important;
                bottom: auto !important;
                width: 100% !important;
                max-width: 200px !important;
                height: 180px !important;
                object-fit: contain !important;
                margin: 16px auto 0 !important;
                display: block !important;
            }

            .center-bottom-split {
                grid-template-columns: 1fr;
                gap: 24px !important;
            }

            .card-exclusive-info,
            .card-focus-chair {
                height: auto;
                min-height: 240px;
                padding: 20px;
            }

            .catalog-section-title {
                font-size: 1.3rem;
            }

            .catalog-grid.scroll-mode .catalog-card {
                width: 220px !important;
                min-width: 220px !important;
                max-width: 220px !important;
                flex: 0 0 220px !important;
            }

            .catalog-card {
                padding: 14px;
            }

            .catalog-img-box {
                height: 150px;
            }
        }

        /* SITE FOOTER STYLES */
        .site-footer {
            background: #0f172a;
            color: #f8fafc;
            border-radius: 32px 32px 0 0;
            padding: 60px 40px 40px;
            margin-top: 80px;
            box-shadow: 0 -20px 40px rgba(15, 23, 42, 0.05);
        }

        .footer-container {
            max-width: 1760px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1.5fr;
            gap: 40px;
            margin-bottom: 48px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .footer-brand .brand-icon {
            width: 36px;
            height: 36px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-brand .brand-icon svg {
            width: 20px;
            height: 20px;
            fill: #ffffff;
        }

        .footer-brand .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #ffffff;
        }

        .footer-tagline {
            color: #94a3b8;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 24px;
            max-width: 360px;
        }

        .footer-column h4 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: #38bdf8;
        }

        .footer-newsletter input {
            width: 100%;
            padding: 12px 16px;
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            color: #ffffff;
            font-size: 0.88rem;
            margin-bottom: 10px;
            outline: none;
        }

        .footer-newsletter button {
            width: 100%;
            padding: 12px 16px;
            background: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .footer-newsletter button:hover {
            background: #1d4ed8;
        }

        .footer-bottom {
            max-width: 1760px;
            margin: 0 auto;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #64748b;
            font-size: 0.85rem;
        }

        @media (max-width: 1024px) {
            .footer-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .footer-container {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }
        }

        /* Toast Notification Position (Bottom Right Corner) */
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

    <!-- DYNAMIC ISLAND NAVBAR (CLEAN WHITE THEME) -->
    <div class="nav-container">

        @php

            // dd(Auth::guard('admin')->check()? Auth::guard('admin')->user():'');
        @endphp

        <!-- {{ Auth::guard('admin')->check()? Auth::guard('admin')->user()->name:'No Login' }} -->

        <nav class="navbar" id="dynamicNavbar">
            <div class="nav-header">
                <div class="nav-left">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                </div>

                <div class="nav-links">
                    <span class="nav-link active" onclick="filterCategory('All', this)">All</span>
                    <span class="nav-link" onclick="filterCategory('Audio', this)">Audio</span>
                    <span class="nav-link" onclick="filterCategory('Gaming', this)">Gaming</span>
                    <span class="nav-link" onclick="filterCategory('Furniture', this)">Furniture</span>
                    <span class="nav-link" onclick="filterCategory('Tech', this)">Tech</span>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <!-- User Profile Dropdown Icon -->
                    <div class="profile-dropdown-wrapper">
                        <button class="profile-icon-btn" aria-label="User Account" onclick="toggleNav();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
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

                                <a href="{{ route('user.login') }}" class="btn-profile-login"
                                    onclick="showToast('Redirecting to Login Page...');">
                                    🔑 Login / Sign Up
                                </a>

                            @endif
                            <a href="{{ route('admin.index') }}" class="profile-menu-link"
                                style="color: #38bdf8; font-weight: 700;">⚙️ Admin Panel</a>
                            <a href="{{ route('seller.index') }}" class="profile-menu-link"
                                style="color: #16a34a; font-weight: 700;">🏬 Seller Central</a>
                            <a href="#" class="profile-menu-link" onclick="showToast('Opening My Orders...')">📦 My
                                Orders</a>
                            <a href="#" class="profile-menu-link" onclick="showToast('Opening Wishlist...')">❤️ Saved
                                Wishlist</a>
                            <a href="#" class="profile-menu-link" onclick="showToast('Opening Customer Support...')">🎧
                                Customer Support</a>
                        </div>
                    </div>

                    <button class="cart-btn" onclick="toggleNav();">
                        🛒 Cart <span class="cart-count" id="cartCount">0</span>
                    </button>
                    <button class="expand-toggle" aria-label="Toggle Navigation" onclick="toggleNav();">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Expanded Drawer containing Side Nav Sections (Cart & Recently Viewed) -->
            <div class="nav-expanded-content">
                <div class="expanded-top-bar">
                    <div class="search-box">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                        </svg>
                        <form action="{{ route('user.search') }}" method="GET" style="width: 100%; display: flex; align-items: center;">
                            <input type="text" name="q" id="drawerSearchInput"
                                placeholder="Search tech, furniture, graphics cards..."
                                value="{{ request('q') }}"
                                onkeyup="searchItems()" style="width: 100%; border: none; background: transparent; outline: none; color: inherit; font-size: inherit;">
                        </form>
                    </div>
                </div>

                <div class="drawer-grid">
                    <!-- Cart Section -->
                    <div class="drawer-section">
                        <div class="drawer-title">
                            <span>YOUR SHOPPING CART</span>
                            <span id="cartTotalDisplay" style="color: #2563eb; font-weight: 700;">₹0.00</span>
                        </div>
                        <div class="cart-items-list" id="cartItemsList">
                            <div style="color: #64748b; font-size: 0.8rem; text-align: center; padding: 12px;">Your cart
                                is empty.</div>
                        </div>
                        <button class="cart-checkout-btn" onclick="alert('Proceeding to Checkout!')">Checkout
                            Now</button>
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

    <!-- MAIN PAGE WRAPPER -->
    <main class="page-wrapper">
        <!-- Bento Spotlight Layout -->
        <div class="bento-grid" id="bentoContainer">
            <!-- COLUMN 1: NEW DEALS HERO -->
            <div class="card-new-deals item-card" data-category="Sofa Chair Furniture"
                onclick="window.location.href='deals.blade.php'" style="cursor: pointer;">
                <div class="deals-header">
                    <div class="deals-title">New Deals</div>
                    <span class="deals-badge">Hot Pick</span>
                </div>

                <div class="floating-product-card" id="carouselCard"
                    onclick="event.stopPropagation(); window.location.href='{{ route('user.product.show') }}'">
                    <div class="floating-product-header">
                        <div>
                            <div class="product-price-tag" id="heroPrice"></div>
                            <div class="product-sub-name" id="heroTitle"></div>
                        </div>
                        <div class="rating-badge">★ <span id="heroRating"></span></div>
                    </div>
                    <img src="" alt="Hero Product" class="product-preview-img"
                        id="heroImg">
                    <div class="floating-card-actions">
                        <button class="action-circle-btn"
                            onclick="event.stopPropagation(); showToast('Added to Wishlist!')">❤️</button>
                        <button class="action-circle-btn"
                            onclick="event.stopPropagation(); addHeroToCart()">🛍️</button>
                    </div>
                </div>

                <div class="slider-controls" onclick="event.stopPropagation();">
                    <button class="slider-arrow" onclick="prevHeroProduct()">←</button>
                    <span id="heroIndex"></span>
                    <button class="slider-arrow dark" onclick="nextHeroProduct()">→</button>
                </div>
            </div>

            <!-- COLUMN 2: CENTER STACK -->
            <div class="column-center">
                <div class="card-value-deals item-card" id="valueDealsCard" data-category="Audio Tech"
                    onclick="window.location.href='deals.blade.php'"
                    style="cursor: pointer; background: linear-gradient(135deg, #ffffff, #f8fafc); position: relative;">
                    <div class="value-deal-content-wrap" style="z-index: 2; max-width: 55%;">
                        <span
                            style="background: #ef4444; color: #ffffff; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; margin-bottom: 8px;"
                            id="valueBadge"></span>
                        <div class="value-deals-title" style="font-size: 2.1rem; line-height: 1.1;">Great Value Deals
                        </div>
                        <div class="value-deals-sub" style="margin-top: 6px;" id="valueSubTitle"></div>

                        <div style="display: flex; align-items: center; gap: 10px; margin-top: 14px;">
                            <span
                                style="font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; font-weight: 800; color: #0f172a;"
                                id="valuePrice"></span>
                            <span style="font-size: 1rem; color: #94a3b8; text-decoration: line-through;"
                                id="valueOldPrice"></span>
                        </div>

                        <div style="display: flex; gap: 8px; margin-top: 14px;">
                            <span class="rating-badge" style="width: fit-content; font-size: 0.75rem;"
                                id="valueRating"></span>
                            <span class="rating-badge"
                                style="width: fit-content; font-size: 0.75rem; background: #eff6ff; color: #1e40af;">⚡
                                Limited Time</span>
                        </div>
                    </div>
                    <img src="" alt="Value Deal Image" class="hero-center-img"
                        id="valueImg">
                </div>

                <div class="center-bottom-split">
                    <div class="card-exclusive-info item-card" id="exclusiveReleaseCard" data-category="Gaming Tech">
                        <img src="" class="card-exclusive-bg-img" id="exBgImg"
                            alt="Exclusive Background">
                        <div class="card-exclusive-content">
                            <span class="pill-tag" id="exPill"></span>
                            <div>
                                <div class="exclusive-title" id="exTitle" style="color: #ffffff;"></div>
                                <div class="exclusive-desc" id="exDesc" style="color: #cbd5e1;"></div>
                            </div>
                            <button class="subscribe-btn" id="exBtn"
                                style="margin-top: 10px; background: #ffffff; color: #0f172a; border: none; font-weight: 800;"
                                onclick="addExclusiveToCart()"></button>
                        </div>
                    </div>

                    @php
                        if (isset($focusCard) && $focusCard) {
                            $focusName = $focusCard->title;
                            $focusPrice = $focusCard->price;
                            $focusImg = $focusCard->image ? (\Illuminate\Support\Str::startsWith($focusCard->image, ['http://', 'https://']) ? $focusCard->image : asset($focusCard->image)) : '';
                            $focusProductId = $focusCard->product_id;
                        } else {
                            $fp = isset($products) && count($products) > 0 ? $products[0] : null;
                            $focusName = $fp->name ?? 'Featured Item';
                            $focusPrice = $fp->price ?? 0;
                            $focusImg = $fp && $fp->image ? (\Illuminate\Support\Str::startsWith($fp->image, ['http://', 'https://']) ? $fp->image : asset($fp->image)) : '';
                            $focusProductId = $fp->id ?? '';
                        }
                    @endphp
                    <div class="card-focus-chair item-card"
                        onclick="if('{{ $focusProductId }}'){ window.location.href='{{ url('/product') }}/{{ $focusProductId }}'; }"
                        style="background: #f1f5f9; display: flex; flex-direction: column; justify-content: space-between; position: relative; cursor: pointer;">
                        @if($focusImg)
                            <img src="{{ $focusImg }}" alt="{{ $focusName }}" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit: cover; z-index: 1;">
                        @endif
                        <div style="position: relative; z-index: 2; padding: 12px; font-weight: 700; color: #0f172a; max-width: 75%; text-shadow: 0 1px 3px rgba(255,255,255,0.9);">
                            {{ $focusName }}
                        </div>
                        <button class="heart-float-btn" style="z-index: 2;" onclick="event.stopPropagation(); showToast('Saved to Wishlist!')">❤️</button>
                        <div class="open-pill-btn" style="z-index: 2;"
                            onclick="event.stopPropagation(); addToCart('{{ addslashes($focusName) }}', {{ $focusPrice }}, '{{ $focusImg }}')">
                            +₹{{ number_format($focusPrice, 2) }}
                            <div class="open-arrow-black">🛍️</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUMN 3: RIGHT WIDGETS -->
            <div class="column-right">
                <!-- Recently Viewed Items Block -->
                <div class="widget-card">
                    <div class="widget-header">
                        <span class="widget-tag">RECENTLY VIEWED</span>
                        <button class="arrow-corner-btn" onclick="window.location.href='#catalogSection'">↗</button>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
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
                                    style="background: #f8fafc; cursor: pointer; border-radius: 12px; padding: 6px 8px; transition: background 0.2s ease;">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <img src="{{ $rpImg }}" alt="{{ $rp->name }}" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';"
                                                style="width: 38px; height: 38px; border-radius: 8px; object-fit: cover; border: 1px solid #e2e8f0;">
                                            <div>
                                                <div style="font-weight: 700; color: #0f172a; font-size: 0.85rem;">{{ Str::limit($rp->name, 22) }}</div>
                                                <div style="color: #2563eb; font-weight: 700; font-size: 0.8rem;">₹{{ number_format($rp->price, 2) }}</div>
                                            </div>
                                        </div>
                                        <button class="action-circle-btn" style="padding: 4px 8px; font-size: 0.75rem;"
                                            onclick="event.stopPropagation(); addToCart('{{ addslashes($rp->name) }}', {{ $rp->price }}, '{{ addslashes($rpImg) }}')">
                                            🛍️
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="color: #94a3b8; font-size: 0.8rem; padding: 6px;">No recently viewed items yet.</div>
                        @endif
                    </div>
                </div>

                <!-- Special Offer Promo Card -->
                <div class="widget-card" style="background: linear-gradient(135deg, #0f172a, #1e293b); color: #ffffff;">
                    <div class="widget-header">
                        <span class="widget-tag"
                            style="background: rgba(255,255,255,0.15); color: #38bdf8;">PROMO</span>
                        <button class="arrow-corner-btn"
                            style="background: rgba(255,255,255,0.1); color: #ffffff;">↗</button>
                    </div>
                    <div
                        style="font-family: 'Space Grotesk', sans-serif; font-size: 1.2rem; font-weight: 700; margin-bottom: 6px;">
                        Express Delivery</div>
                    <div style="font-size: 0.82rem; color: #94a3b8; line-height: 1.4;">Free same-day shipping on orders
                        over ₹999.</div>
                </div>
            </div>
        </div>

        <!-- STORE CATALOG GROUPED BY CATEGORIES -->
        <section id="catalogSection" style="margin-top: 40px; display: flex; flex-direction: column; gap: 48px;">
            <!-- Category Filter Chips relocated directly above products -->
            <div class="category-nav-bar" style="margin-bottom: 0;">
                <div class="cat-chip active" onclick="filterCategory('All', this)">All Items</div>
                @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $c)
                        <div class="cat-chip" onclick="filterCategory('{{ addslashes($c->name) }}', this)">{{ $c->icon_emoji ?? '' }} {{ $c->name }}</div>
                    @endforeach
                @else
                    <div class="cat-chip" onclick="filterCategory('Audio', this)">Audio Gear</div>
                    <div class="cat-chip" onclick="filterCategory('Gaming', this)">Gaming PC</div>
                    <div class="cat-chip" onclick="filterCategory('Furniture', this)">Furniture</div>
                    <div class="cat-chip" onclick="filterCategory('Tech', this)">Tech & Wearables</div>
                @endif
            </div>

            @php
                $groupedProducts = isset($products) ? $products->groupBy('category_id') : collect();
                $displayedCatIds = [];
            @endphp

            @if(isset($categories) && count($categories) > 0)
                @foreach($categories as $catModel)
                    @php
                        $catProducts = $groupedProducts->get($catModel->id, collect());
                        $displayedCatIds[] = $catModel->id;
                        $gridId = 'catGrid_' . $catModel->id;
                    @endphp
                    @if($catProducts->count() > 0)
                    <div class="category-block" data-section-category="{{ $catModel->name }}">
                        <div class="catalog-section-title"
                            style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                            <span>{{ $catModel->title }}</span>
                            <div style="display: flex; gap: 8px;">
                                <button class="slider-arrow" onclick="scrollGrid('{{ $gridId }}', -300)"
                                    aria-label="Scroll left">←</button>
                                <button class="slider-arrow dark" onclick="scrollGrid('{{ $gridId }}', 300)"
                                    aria-label="Scroll right">→</button>
                            </div>
                        </div>

                        <div class="catalog-grid" id="{{ $gridId }}">
                            @foreach($catProducts as $product)
                                @php
                                    $imgObj = $product->primaryImage ?? ($product->images ? $product->images->first() : null);
                                    $imgPath = $imgObj ? $imgObj->image : null;
                                    if ($imgPath) {
                                        $imgSrc = \Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://']) ? $imgPath : asset($imgPath);
                                    } else {
                                        $imgSrc = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                                    }
                                @endphp
                                <div class="catalog-card item-card" data-category="{{ $catModel->name }} {{ $product->name }}"
                                    onclick="window.location.href='{{ route('user.product.show', $product->id) }}'">
                                    <div class="catalog-img-box">
                                        <span class="badge-cat">{{ $catModel->name }}</span>
                                        <img src="{{ $imgSrc }}" alt="{{ $product->name }}" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';">
                                    </div>
                                    <div class="catalog-title">{{ $product->name }}</div>
                                    <div class="catalog-desc">{{ $product->description ?? 'High performance product from store inventory.' }}</div>
                                    <div class="catalog-bottom">
                                        <div>
                                            <span class="catalog-price">₹{{ number_format($product->price) }}</span>
                                            @if($product->old_price)
                                                <span style="font-size: 0.8rem; color: #94a3b8; text-decoration: line-through; margin-left: 4px;">₹{{ number_format($product->old_price) }}</span>
                                            @endif
                                        </div>
                                        <button class="add-cart-btn"
                                            onclick="event.stopPropagation(); addToCart('{{ addslashes($product->name) }}', {{ $product->price }}, '{{ addslashes($imgSrc) }}')">+
                                            Cart</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif

            @php
                $otherProducts = isset($products) ? $products->filter(function($p) use ($displayedCatIds) {
                    return !in_array($p->category_id, $displayedCatIds);
                }) : collect();
            @endphp
            @if($otherProducts->count() > 0)
                <div class="category-block" data-section-category="General">
                    <div class="catalog-section-title"
                        style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                        <span>📦 Other Store Products</span>
                        <div style="display: flex; gap: 8px;">
                            <button class="slider-arrow" onclick="scrollGrid('otherCatalogGrid', -300)"
                                aria-label="Scroll left">←</button>
                            <button class="slider-arrow dark" onclick="scrollGrid('otherCatalogGrid', 300)"
                                aria-label="Scroll right">→</button>
                        </div>
                    </div>

                    <div class="catalog-grid" id="otherCatalogGrid">
                        @foreach($otherProducts as $product)
                            @php
                                $imgObj = $product->primaryImage ?? ($product->images ? $product->images->first() : null);
                                $imgPath = $imgObj ? $imgObj->image : null;
                                if ($imgPath) {
                                    $imgSrc = \Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://']) ? $imgPath : asset($imgPath);
                                } else {
                                    $imgSrc = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                                }
                            @endphp
                            <div class="catalog-card item-card" data-category="General {{ $product->name }}"
                                onclick="window.location.href='{{ route('user.product.show', $product->id) }}'">
                                <div class="catalog-img-box">
                                    <span class="badge-cat">General</span>
                                    <img src="{{ $imgSrc }}" alt="{{ $product->name }}" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';">
                                </div>
                                <div class="catalog-title">{{ $product->name }}</div>
                                <div class="catalog-desc">{{ $product->description ?? 'High performance product from store inventory.' }}</div>
                                <div class="catalog-bottom">
                                    <div>
                                        <span class="catalog-price">₹{{ number_format($product->price) }}</span>
                                        @if($product->old_price)
                                            <span style="font-size: 0.8rem; color: #94a3b8; text-decoration: line-through; margin-left: 4px;">₹{{ number_format($product->old_price) }}</span>
                                        @endif
                                    </div>
                                    <button class="add-cart-btn"
                                        onclick="event.stopPropagation(); addToCart('{{ addslashes($product->name) }}', {{ $product->price }}, '{{ addslashes($imgSrc) }}')">+
                                        Cart</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    </main>

    <!-- SITE FOOTER -->
    <footer class="site-footer">
        <div class="footer-container">
            <div>
                <div class="footer-brand">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                </div>
                <p class="footer-tagline">
                    Experience futuristic shopping with UnCart. Next-generation tech gear, Scandinavian furniture, and
                    luxury essentials delivered across India.
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
                <p style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 12px;">Subscribe to get exclusive discount
                    codes & weekly deal updates.</p>
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
        <svg width="20" height="20" viewBox="0 0 24 24" fill="#38bdf8">
            <path
                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
        </svg>
        <span id="toastMsg">Item added to cart!</span>
    </div>

    @php
        $formattedHeroProducts = (isset($heroCarouselCards) && $heroCarouselCards->count() > 0) 
            ? $heroCarouselCards->map(function($c) {
                $imgPath = $c->image ? (\Illuminate\Support\Str::startsWith($c->image, ['http://', 'https://']) ? $c->image : asset($c->image)) : 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                return [
                    'id' => $c->product_id ?? '',
                    'title' => $c->title,
                    'price' => (float)$c->price,
                    'rating' => $c->rating ?? '4.9',
                    'img' => $imgPath,
                ];
            })->values()
            : [
                ['id' => '', 'title' => 'Sony WH-1000XM5 Headphones', 'price' => 29990, 'rating' => '4.9', 'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80']
            ];

        $formattedFlashSale = (isset($flashSaleCards) && $flashSaleCards->count() > 0)
            ? $flashSaleCards->map(function($c) {
                $imgPath = $c->image ? (\Illuminate\Support\Str::startsWith($c->image, ['http://', 'https://']) ? $c->image : asset($c->image)) : 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                return [
                    'id' => $c->product_id ?? '',
                    'badge' => $c->badge ?? 'FLASHSALE 50% OFF',
                    'subtitle' => $c->subtitle ?? $c->title,
                    'price' => (float)$c->price,
                    'oldPrice' => (float)($c->old_price ?? ($c->price * 1.2)),
                    'rating' => $c->rating ?? '🏷️ 4.9 Rating',
                    'img' => $imgPath,
                ];
            })->values()
            : [
                ['id' => '', 'badge' => 'FLASHSALE 50% OFF', 'subtitle' => 'Studio Pro ANC Headphones with Lossless Audio', 'price' => 24999, 'oldPrice' => 34999, 'rating' => '🏷️ 4.9 Rating', 'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80']
            ];

        $formattedExclusive = (isset($exclusiveReleaseCards) && $exclusiveReleaseCards->count() > 0)
            ? $exclusiveReleaseCards->map(function($c) {
                $imgPath = $c->image ? (\Illuminate\Support\Str::startsWith($c->image, ['http://', 'https://']) ? $c->image : asset($c->image)) : 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                return [
                    'id' => $c->product_id ?? '',
                    'tag' => $c->badge ?? 'EXCLUSIVE RELEASE',
                    'title' => $c->title,
                    'desc' => $c->subtitle ?? '',
                    'price' => (float)$c->price,
                    'img' => $imgPath,
                ];
            })->values()
            : [
                ['id' => '', 'tag' => 'EXCLUSIVE RELEASE', 'title' => 'GeForce RTX GPU', 'desc' => 'Next-gen liquid cooling graphics architecture.', 'price' => 74999, 'img' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=800&q=80']
            ];
    @endphp

    <script>
        const heroProducts = @json($formattedHeroProducts);
        const valueDealsData = @json($formattedFlashSale);
        const exclusiveReleases = @json($formattedExclusive);

        let currentHeroIdx = 0;
        let cart = [];

        function toggleNav() {
            const navbar = document.getElementById('dynamicNavbar');
            navbar.classList.toggle('expanded');
        }

        // Close navbar when clicking anywhere outside the nav bar
        document.addEventListener('click', function (e) {
            const navbar = document.getElementById('dynamicNavbar');
            if (navbar && !navbar.contains(e.target) && navbar.classList.contains('expanded')) {
                navbar.classList.remove('expanded');
            }
        });

        let currentValueIdx = 0;

        function updateHeroCarousel() {
            if (!heroProducts || heroProducts.length === 0) return;
            const card = document.getElementById('carouselCard');
            if (card) {
                card.classList.remove('auto-anim-flip');
                void card.offsetWidth; // trigger reflow for animation restart
                card.classList.add('auto-anim-flip');
            }

            const item = heroProducts[currentHeroIdx];
            document.getElementById('heroTitle').innerText = item.title;
            document.getElementById('heroPrice').innerText = '₹' + item.price.toLocaleString('en-IN');
            document.getElementById('heroRating').innerText = item.rating;
            document.getElementById('heroImg').src = item.img;
            document.getElementById('heroIndex').innerText = `${currentHeroIdx + 1} / ${heroProducts.length} Featured`;

            const cardLink = document.getElementById('carouselCard');
            if (cardLink) {
                cardLink.onclick = function(event) {
                    event.stopPropagation();
                    if (item.id) {
                        window.location.href = "{{ url('/product') }}/" + item.id;
                    } else {
                        window.location.href = "{{ route('user.product.show') }}";
                    }
                };
            }
        }

        function nextHeroProduct() {
            if (!heroProducts || heroProducts.length === 0) return;
            currentHeroIdx = (currentHeroIdx + 1) % heroProducts.length;
            updateHeroCarousel();
        }

        function prevHeroProduct() {
            if (!heroProducts || heroProducts.length === 0) return;
            currentHeroIdx = (currentHeroIdx - 1 + heroProducts.length) % heroProducts.length;
            updateHeroCarousel();
        }

        function updateValueDealsCarousel() {
            if (!valueDealsData || valueDealsData.length === 0) return;
            const card = document.getElementById('valueDealsCard');
            if (card) {
                card.classList.remove('auto-anim-zoom');
                void card.offsetWidth; // trigger reflow for animation restart
                card.classList.add('auto-anim-zoom');
            }

            const item = valueDealsData[currentValueIdx];
            document.getElementById('valueBadge').innerText = item.badge;
            document.getElementById('valueSubTitle').innerText = item.subtitle;
            document.getElementById('valuePrice').innerText = '₹' + item.price.toLocaleString('en-IN');
            document.getElementById('valueOldPrice').innerText = '₹' + item.oldPrice.toLocaleString('en-IN');
            document.getElementById('valueRating').innerText = item.rating;
            document.getElementById('valueImg').src = item.img;
        }

        function nextValueDeal() {
            if (!valueDealsData || valueDealsData.length === 0) return;
            currentValueIdx = (currentValueIdx + 1) % valueDealsData.length;
            updateValueDealsCarousel();
        }

        let currentExIdx = 0;

        function updateExclusiveCarousel() {
            if (!exclusiveReleases || exclusiveReleases.length === 0) return;
            const card = document.getElementById('exclusiveReleaseCard');
            if (card) {
                card.classList.remove('auto-anim-glow');
                void card.offsetWidth; // trigger reflow for animation restart
                card.classList.add('auto-anim-glow');
            }

            const item = exclusiveReleases[currentExIdx];
            document.getElementById('exPill').innerText = item.tag;
            document.getElementById('exTitle').innerText = item.title;
            document.getElementById('exDesc').innerText = item.desc;
            document.getElementById('exBtn').innerText = 'Add — ₹' + item.price.toLocaleString('en-IN');
            const bgImg = document.getElementById('exBgImg');
            if (bgImg) { bgImg.src = item.img; }
        }

        function nextExclusiveRelease() {
            if (!exclusiveReleases || exclusiveReleases.length === 0) return;
            currentExIdx = (currentExIdx + 1) % exclusiveReleases.length;
            updateExclusiveCarousel();
        }

        function addExclusiveToCart() {
            const item = exclusiveReleases[currentExIdx];
            addToCart(item.title, item.price, item.img);
        }

        function addHeroToCart() {
            const item = heroProducts[currentHeroIdx];
            addToCart(item.title, item.price, item.img);
        }

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
            document.getElementById('cartCount').innerText = data.count || 0;
            const itemsList = document.getElementById('cartItemsList');
            const totalDisplay = document.getElementById('cartTotalDisplay');

            if (!data.cart || data.cart.length === 0) {
                itemsList.innerHTML = '<div style="color: #64748b; font-size: 0.8rem; text-align: center; padding: 12px;">Your cart is empty.</div>';
                totalDisplay.innerText = '₹0.00';
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

            totalDisplay.innerText = data.formatted_total || '₹0.00';
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

        function scrollGrid(gridId, amount) {
            const container = document.getElementById(gridId);
            if (container) {
                container.scrollBy({ left: amount, behavior: 'smooth' });
            }
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = message;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        function filterCategory(cat, element) {
            if (element) {
                document.querySelectorAll('.cat-chip, .nav-link').forEach(el => el.classList.remove('active'));
                element.classList.add('active');
            }

            const catalogGrids = document.querySelectorAll('.catalog-grid');
            if (cat === 'All') {
                catalogGrids.forEach(g => g.classList.add('scroll-mode'));
            } else {
                catalogGrids.forEach(g => g.classList.remove('scroll-mode'));
            }

            const categoryBlocks = document.querySelectorAll('.category-block');
            let visibleIndex = 0;

            categoryBlocks.forEach(block => {
                let hasVisibleCards = false;
                const cards = block.querySelectorAll('.catalog-card');

                cards.forEach(card => {
                    const itemCats = card.dataset.category || '';
                    if (cat === 'All' || itemCats.toLowerCase().includes(cat.toLowerCase())) {
                        card.style.display = 'flex';
                        card.classList.remove('active');
                        const delay = 100 + (visibleIndex * 80);
                        setTimeout(() => card.classList.add('active'), delay);
                        visibleIndex++;
                        hasVisibleCards = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (hasVisibleCards) {
                    block.style.display = 'block';
                } else {
                    block.style.display = 'none';
                }
            });

            // Smooth scroll down to catalog if filtered
            if (cat !== 'All') {
                document.getElementById('catalogSection').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function searchItems() {
            const query = document.getElementById('drawerSearchInput').value.toLowerCase();
            const categoryBlocks = document.querySelectorAll('.category-block');
            let visibleIndex = 0;

            categoryBlocks.forEach(block => {
                let hasVisibleCards = false;
                const cards = block.querySelectorAll('.catalog-card');
                cards.forEach(card => {
                    const text = card.innerText.toLowerCase();
                    if (text.includes(query)) {
                        card.style.display = 'flex';
                        card.classList.remove('active');
                        const delay = 100 + (visibleIndex * 80);
                        setTimeout(() => card.classList.add('active'), delay);
                        visibleIndex++;
                        hasVisibleCards = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (hasVisibleCards) {
                    block.style.display = 'block';
                } else {
                    block.style.display = 'none';
                }
            });
        }

        // Scroll Reveal Observer
        const observerOptions = { threshold: 0.15 };
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            // Fetch dynamic database cart items
            fetchCart();

            // Immediately populate initial hero section items from dynamic DB array
            updateHeroCarousel();
            updateValueDealsCarousel();
            updateExclusiveCarousel();

            // Apply single-row horizontal scroll mode by default when 'All' is active
            document.querySelectorAll('.catalog-grid').forEach(g => g.classList.add('scroll-mode'));

            const revealElements = document.querySelectorAll('.category-nav-bar, .bento-grid, .card-new-deals, .card-value-deals, .widget-card, .catalog-card, #catalogSection');
            revealElements.forEach(el => {
                el.classList.add('reveal');
                revealObserver.observe(el);
            });

            // Synchronized Auto-rotate: New Deals, Great Value Deals & Exclusive Release swap simultaneously every 5 seconds
            setInterval(() => {
                nextHeroProduct();
                nextValueDeal();
                nextExclusiveRelease();
            }, 5000);
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