<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Orders — UnCart Marketplace</title>
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

        /* -------------------------------------------------------------
           DYNAMIC ISLAND NAVBAR (EXACT MATCH TO STOREFRONT HOME)
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
            width: 230px;
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
            display: block;
            width: 100%;
            text-align: center;
            background: #0f172a;
            color: #ffffff;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 8px;
            border-radius: 12px;
            text-decoration: none;
            margin-bottom: 6px;
            border: none;
            cursor: pointer;
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

        .navbar.expanded {
            width: 680px;
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
            max-height: 550px;
            opacity: 1;
        }

        .drawer-search-bar {
            padding: 12px 14px 0;
        }

        .drawer-search-input-wrap {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #64748b;
        }

        .drawer-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 14px;
            padding: 14px;
        }

        .drawer-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 14px;
        }

        .drawer-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .cart-checkout-btn {
            width: 100%;
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s ease;
        }

        .cart-checkout-btn:hover {
            background: #2563eb;
        }

        /* -------------------------------------------------------------
           MY ORDERS PAGE WRAPPER & RICH CONTENT
        ------------------------------------------------------------- */
        .orders-page-wrapper {
            max-width: 1240px;
            margin: 0 auto;
            padding: 100px 24px 80px;
        }

        .page-header-banner {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-title-group h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .header-title-group p {
            color: #64748b;
            font-size: 0.95rem;
            margin-top: 4px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn-action-light {
            background: #ffffff;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            padding: 10px 18px;
            border-radius: 14px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
            transition: all 0.2s ease;
        }

        .btn-action-light:hover {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        /* BENTO STATS CARDS */
        .stats-bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 36px;
        }

        @media (max-width: 900px) {
            .stats-bento-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .stats-bento-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-bento-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 22px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.25s ease;
        }

        .stat-bento-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stat-icon-wrap.blue { background: #eff6ff; color: #2563eb; }
        .stat-icon-wrap.amber { background: #fffbeb; color: #d97706; }
        .stat-icon-wrap.green { background: #f0fdf4; color: #16a34a; }
        .stat-icon-wrap.purple { background: #faf5ff; color: #9333ea; }

        .stat-info .stat-value {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
        }

        .stat-info .stat-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* FILTER TABS & SEARCH BAR */
        .controls-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 18px 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filter-tabs {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .filter-tab-btn {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid transparent;
            padding: 8px 16px;
            border-radius: 16px;
            font-size: 0.84rem;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .filter-tab-btn:hover {
            color: #0f172a;
            background: #e2e8f0;
        }

        .filter-tab-btn.active {
            background: #0f172a;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
        }

        .search-order-wrap {
            position: relative;
            min-width: 260px;
        }

        .search-order-input {
            width: 100%;
            padding: 10px 16px 10px 38px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #0f172a;
            outline: none;
        }

        .search-order-input:focus {
            background: #ffffff;
            border-color: #2563eb;
        }

        .search-order-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        /* -------------------------------------------------------------
           ORDER CARDS STYLING
        ------------------------------------------------------------- */
        .orders-list-group {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .order-card {
            background: #ffffff;
            border-radius: 28px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .order-card:hover {
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.07);
            border-color: #cbd5e1;
        }

        .order-card-header {
            background: #f8fafc;
            padding: 20px 28px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .order-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .order-id-badge {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: #0f172a;
            letter-spacing: -0.2px;
        }

        .order-date-text {
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 500;
        }

        .order-header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .status-pill {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pill.processing { background: #eff6ff; color: #2563eb; }
        .status-pill.shipped { background: #f0fdf4; color: #16a34a; }
        .status-pill.delivered { background: #f0fdf4; color: #15803d; }
        .status-pill.cancelled { background: #fef2f2; color: #b91c1c; }

        /* TRACKER TIMELINE STEPPER */
        .tracker-container {
            padding: 20px 28px;
            background: #ffffff;
            border-bottom: 1px solid #f8fafc;
        }

        .tracker-stepper {
            display: flex;
            justify-content: space-between;
            position: relative;
            max-width: 700px;
            margin: 0 auto;
        }

        .tracker-stepper::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 40px;
            right: 40px;
            height: 3px;
            background: #e2e8f0;
            z-index: 1;
        }

        .step-item {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 25%;
        }

        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            color: #94a3b8;
            font-size: 0.78rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            transition: all 0.3s ease;
        }

        .step-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
        }

        .step-item.completed .step-circle {
            background: #16a34a;
            border-color: #16a34a;
            color: #ffffff;
        }

        .step-item.active .step-circle {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        }

        .step-item.completed .step-label,
        .step-item.active .step-label {
            color: #0f172a;
        }

        /* ORDER BODY & ITEM ROWS */
        .order-card-body {
            padding: 24px 28px;
        }

        .items-list-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 24px;
        }

        .order-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 16px;
            border-bottom: 1px dashed #f1f5f9;
            gap: 16px;
        }

        .order-item-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .item-main-details {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .item-product-img {
            width: 68px;
            height: 68px;
            border-radius: 16px;
            object-fit: cover;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .order-item-row:hover .item-product-img {
            transform: scale(1.05);
        }

        .item-name-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .item-specs-badge {
            font-size: 0.78rem;
            color: #64748b;
            font-weight: 500;
        }

        .item-price-col {
            text-align: right;
        }

        .item-unit-price {
            font-size: 0.95rem;
            font-weight: 800;
            color: #0f172a;
        }

        .item-qty-tag {
            font-size: 0.78rem;
            color: #64748b;
            font-weight: 600;
        }

        .btn-buy-again {
            background: #f1f5f9;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 6px;
        }

        .btn-buy-again:hover {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        /* ORDER FOOTER & SUMMARY METRICS */
        .order-card-footer {
            background: #f8fafc;
            padding: 20px 28px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .shipping-dest-info {
            font-size: 0.82rem;
            color: #64748b;
        }

        .shipping-dest-info strong {
            color: #0f172a;
        }

        .order-total-price {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
        }

        .footer-btn-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary-sm {
            background: #0f172a;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 14px;
            font-size: 0.82rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-primary-sm:hover {
            background: #2563eb;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
        }

        .btn-secondary-sm {
            background: #ffffff;
            color: #0f172a;
            border: 1px solid #cbd5e1;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 14px;
            font-size: 0.82rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-secondary-sm:hover {
            background: #f1f5f9;
        }

        /* EMPTY ORDERS SECTION */
        .empty-orders-card {
            background: #ffffff;
            border-radius: 32px;
            padding: 64px 32px;
            text-align: center;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
        }

        .empty-orders-icon {
            width: 80px;
            height: 80px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 20px;
            color: #64748b;
        }

        .empty-orders-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .empty-orders-desc {
            color: #64748b;
            font-size: 0.95rem;
            max-width: 460px;
            margin: 0 auto 24px;
        }

        .btn-explore-now {
            display: inline-block;
            background: #0f172a;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 18px;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
            transition: all 0.25s ease;
        }

        .btn-explore-now:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        /* RECOMMENDED PRODUCTS SECTION */
        .recommended-section {
            margin-top: 60px;
        }

        .rec-section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
        }

        .rec-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 900px) {
            .rec-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .rec-grid {
                grid-template-columns: 1fr;
            }
        }

        .rec-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.03);
            text-decoration: none;
            color: inherit;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .rec-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.08);
            border-color: #2563eb;
        }

        .rec-img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 14px;
            margin-bottom: 12px;
            background: #f1f5f9;
        }

        .rec-title {
            font-weight: 700;
            font-size: 0.88rem;
            color: #0f172a;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rec-price {
            font-weight: 800;
            font-size: 0.95rem;
            color: #2563eb;
        }

        /* TOAST NOTIFICATION */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #0f172a;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 16px;
            font-size: 0.88rem;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.25);
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 2000;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
</head>

<body>

    <!-- -------------------------------------------------------------
         DYNAMIC ISLAND NAVBAR (MATCHES ALL STORE PAGES)
    ------------------------------------------------------------- -->
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
                    <a href="{{ route('user.index') }}" class="nav-link">Store</a>
                    <a href="{{ route('user.search') }}" class="nav-link">Explore</a>
                    <a href="{{ route('user.orders') }}" class="nav-link active">My Orders</a>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <!-- User Profile Dropdown Component -->
                    <div class="profile-dropdown-wrapper">
                        <button class="profile-icon-btn" aria-label="User Account" onclick="toggleNav();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                <a href="{{ route('user.login') }}" class="btn-profile-login">
                                    🔑 Login / Sign Up
                                </a>
                            @endif

                            <a href="{{ route('admin.index') }}" class="profile-menu-link" style="color: #38bdf8; font-weight: 700;">⚙️ Admin Panel</a>
                            <a href="{{ route('seller.index') }}" class="profile-menu-link" style="color: #16a34a; font-weight: 700;">🏬 Seller Central</a>
                            <a href="{{ route('user.orders') }}" class="profile-menu-link">📦 My Orders</a>
                            <a href="{{ route('user.checkout') }}" class="profile-menu-link" style="color: #2563eb; font-weight: 700;">💳 Checkout</a>
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

            <!-- Expanded Drawer containing Side Nav Sections (Cart & Search) -->
            <div class="nav-expanded-content">
                <div class="drawer-search-bar">
                    <div class="drawer-search-input-wrap">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <form action="{{ route('user.search') }}" method="GET" style="width: 100%; display: flex; align-items: center;">
                            <input type="text" name="q" id="drawerSearchInput" placeholder="Search catalog..." style="width: 100%; border: none; background: transparent; outline: none; color: inherit; font-size: inherit;">
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
                            <div style="color: #64748b; font-size: 0.8rem; text-align: center; padding: 12px;">Your cart is empty.</div>
                        </div>
                        <button class="cart-checkout-btn" onclick="window.location.href='{{ route('user.checkout') }}'">Proceed to Checkout →</button>
                    </div>

                    <!-- Quick Navigation -->
                    <div class="drawer-section">
                        <div class="drawer-title">
                            <span>QUICK ACTIONS</span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <a href="{{ route('user.index') }}" class="profile-menu-link">🛍️ Continue Shopping</a>
                            <a href="{{ route('user.checkout') }}" class="profile-menu-link" style="color: #2563eb; font-weight: 700;">💳 Checkout Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- -------------------------------------------------------------
         MY ORDERS PAGE CONTENT
    ------------------------------------------------------------- -->
    <main class="orders-page-wrapper">

        <!-- HEADER BANNER -->
        <div class="page-header-banner">
            <div class="header-title-group">
                <h1>My Order History</h1>
                <p>Track live dispatches, review past purchases & download invoices</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('user.index') }}" class="btn-action-light">
                    <span>🛍️ Browse Products</span>
                </a>
                <a href="{{ route('user.checkout') }}" class="btn-action-light" style="background: #0f172a; color: #ffffff; border-color: #0f172a;">
                    <span>💳 View Cart / Checkout</span>
                </a>
            </div>
        </div>

        @php
            $totalOrdersCount = $orders->count();
            $processingCount = $orders->where('order_status', 'processing')->count();
            $deliveredCount = $orders->where('order_status', 'delivered')->count();
            $totalSpent = $orders->sum('total_amount');
        @endphp

        <!-- STATS BENTO GRID -->
        <div class="stats-bento-grid">
            <div class="stat-bento-card">
                <div class="stat-icon-wrap blue">📦</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $totalOrdersCount }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>

            <div class="stat-bento-card">
                <div class="stat-icon-wrap amber">⚡</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $processingCount }}</div>
                    <div class="stat-label">In Progress</div>
                </div>
            </div>

            <div class="stat-bento-card">
                <div class="stat-icon-wrap green">✅</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $deliveredCount }}</div>
                    <div class="stat-label">Delivered</div>
                </div>
            </div>

            <div class="stat-bento-card">
                <div class="stat-icon-wrap purple">💎</div>
                <div class="stat-info">
                    <div class="stat-value">₹{{ number_format($totalSpent, 2) }}</div>
                    <div class="stat-label">Total Value</div>
                </div>
            </div>
        </div>

        <!-- CONTROLS: FILTER TABS & SEARCH BAR -->
        <div class="controls-card">
            <div class="filter-tabs">
                <button class="filter-tab-btn active" onclick="filterOrders('all', this)">All Orders ({{ $totalOrdersCount }})</button>
                <button class="filter-tab-btn" onclick="filterOrders('processing', this)">In Progress ({{ $processingCount }})</button>
                <button class="filter-tab-btn" onclick="filterOrders('delivered', this)">Delivered ({{ $deliveredCount }})</button>
                <button class="filter-tab-btn" onclick="filterOrders('cancelled', this)">Cancelled</button>
            </div>

            <div class="search-order-wrap">
                <svg class="search-order-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="orderSearchInput" class="search-order-input" placeholder="Search Order ID or Product..." onkeyup="searchOrders()">
            </div>
        </div>

        <!-- ORDERS LIST GROUP -->
        @if($orders->isEmpty())
            <div class="empty-orders-card">
                <div class="empty-orders-icon">🛒</div>
                <h2 class="empty-orders-title">No Orders Placed Yet</h2>
                <p class="empty-orders-desc">Looks like you haven't placed any orders yet. Discover our latest collection of tech, furniture, and essentials with express delivery.</p>
                <a href="{{ route('user.index') }}" class="btn-explore-now">Start Shopping Now →</a>
            </div>
        @else
            <div class="orders-list-group" id="ordersListGroup">
                @foreach($orders as $order)
                    <div class="order-card" data-status="{{ strtolower($order->order_status) }}" data-search="{{ strtolower($order->order_number . ' ' . $order->customer_name . ' ' . implode(' ', $order->items->pluck('product_title')->toArray())) }}">
                        
                        <!-- CARD HEADER -->
                        <div class="order-card-header">
                            <div class="order-header-left">
                                <div>
                                    <div class="order-id-badge">{{ $order->order_number }}</div>
                                    <div class="order-date-text">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</div>
                                </div>
                            </div>
                            <div class="order-header-right">
                                <span class="status-pill {{ $order->payment_status === 'paid' ? 'delivered' : 'processing' }}">
                                    💳 Payment {{ ucfirst($order->payment_status) }}
                                </span>
                                <span class="status-pill {{ strtolower($order->order_status) }}">
                                    ● {{ ucfirst($order->order_status) }}
                                </span>
                            </div>
                        </div>

                        <!-- TRACKER TIMELINE STEPPER -->
                        <div class="tracker-container">
                            <div class="tracker-stepper">
                                <div class="step-item completed">
                                    <div class="step-circle">✓</div>
                                    <div class="step-label">Placed</div>
                                </div>
                                <div class="step-item {{ in_array($order->order_status, ['processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                    <div class="step-circle">2</div>
                                    <div class="step-label">Processing</div>
                                </div>
                                <div class="step-item {{ in_array($order->order_status, ['shipped', 'delivered']) ? 'completed' : '' }}">
                                    <div class="step-circle">3</div>
                                    <div class="step-label">Shipped</div>
                                </div>
                                <div class="step-item {{ $order->order_status === 'delivered' ? 'completed' : '' }}">
                                    <div class="step-circle">4</div>
                                    <div class="step-label">Delivered</div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD BODY: ITEMS LIST -->
                        <div class="order-card-body">
                            <div class="items-list-container">
                                @foreach($order->items as $item)
                                    <div class="order-item-row">
                                        <div class="item-main-details">
                                            <img src="{{ $item->image_path ? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset($item->image_path)) : asset('uploads/products/placeholder.png') }}" class="item-product-img" alt="{{ $item->product_title }}">
                                            <div>
                                                <div class="item-name-title">{{ $item->product_title }}</div>
                                                <div class="item-specs-badge">Item Price: ₹{{ number_format($item->price, 2) }}</div>
                                                <button type="button" class="btn-buy-again" onclick="quickAddToCart('{{ addslashes($item->product_title) }}', {{ $item->price }}, '{{ $item->image_path }}', {{ $item->product_id ?? 'null' }})">
                                                    🔄 Buy Again
                                                </button>
                                            </div>
                                        </div>

                                        <div class="item-price-col">
                                            <div class="item-unit-price">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
                                            <div class="item-qty-tag">Quantity: {{ $item->quantity }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CARD FOOTER -->
                        <div class="order-card-footer">
                            <div class="shipping-dest-info">
                                Shipping to: <strong>{{ $order->customer_name }}</strong>, {{ $order->city }}, {{ $order->state }} (PIN {{ $order->zip_code }})
                            </div>

                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div>
                                    <div style="font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Total Amount</div>
                                    <div class="order-total-price">₹{{ number_format($order->total_amount, 2) }}</div>
                                </div>

                                <div class="footer-btn-group">
                                    <a href="{{ route('user.order.confirmation', $order->order_number) }}" class="btn-primary-sm">
                                        View Receipt →
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

        <!-- RECOMMENDED FOR YOU SECTION -->
        <div class="recommended-section">
            <h2 class="rec-section-title">Trending Catalog Essentials</h2>
            <div class="rec-grid">
                <a href="{{ route('user.search') }}" class="rec-card">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80" class="rec-img" alt="">
                    <div>
                        <div class="rec-title">Aura Studio ANC Wireless Headphones</div>
                        <div class="rec-price">₹24,999</div>
                    </div>
                </a>

                <a href="{{ route('user.search') }}" class="rec-card">
                    <img src="https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?auto=format&fit=crop&w=800&q=80" class="rec-img" alt="">
                    <div>
                        <div class="rec-title">Pro Precision Ergonomic Mouse</div>
                        <div class="rec-price">₹8,499</div>
                    </div>
                </a>

                <a href="{{ route('user.search') }}" class="rec-card">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80" class="rec-img" alt="">
                    <div>
                        <div class="rec-title">Nordic Minimalist Bouclé Chair</div>
                        <div class="rec-price">₹34,500</div>
                    </div>
                </a>

                <a href="{{ route('user.search') }}" class="rec-card">
                    <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=800&q=80" class="rec-img" alt="">
                    <div>
                        <div class="rec-title">UltraWide 34" Curved Studio Monitor</div>
                        <div class="rec-price">₹62,000</div>
                    </div>
                </a>
            </div>
        </div>

    </main>

    <!-- TOAST NOTIFICATION -->
    <div id="toast" class="toast">
        <span id="toastMsg">Notification message</span>
    </div>

    <!-- JAVASCRIPT LOGIC -->
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

        function filterOrders(status, btn) {
            document.querySelectorAll('.filter-tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const cards = document.querySelectorAll('.order-card');
            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function searchOrders() {
            const query = document.getElementById('orderSearchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.order-card');

            cards.forEach(card => {
                const text = card.dataset.search || '';
                if (text.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function quickAddToCart(title, price, imgSrc, productId = null) {
            fetch("{{ route('user.cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    title: title,
                    price: price,
                    imgSrc: imgSrc,
                    product_id: productId
                })
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

            if (!itemsList) return;

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
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 8px; border-bottom: 1px solid #f1f5f9;">
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

        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = message;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchCart();
        });
    </script>

</body>

</html>
