<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout — UnCart Marketplace</title>
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
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(15, 23, 42, 0.08);
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
            transition: color 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #2563eb;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 24px 60px;
        }

        .checkout-title-wrap {
            margin-bottom: 32px;
        }

        .checkout-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .checkout-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-top: 6px;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 32px;
            align-items: start;
        }

        @media (max-width: 992px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
        }

        .checkout-card {
            background: #ffffff;
            border-radius: 28px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .step-badge {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #0f172a;
            color: #ffffff;
            font-size: 0.82rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group.full {
            grid-column: span 2;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group.full {
                grid-column: span 1;
            }
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.92rem;
            color: #0f172a;
            font-family: inherit;
            font-weight: 500;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-input:focus {
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .error-msg {
            color: #ef4444;
            font-size: 0.78rem;
            margin-top: 6px;
            font-weight: 600;
        }

        /* Payment Selection Cards */
        .payment-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        @media (max-width: 640px) {
            .payment-options {
                grid-template-columns: 1fr;
            }
        }

        .payment-option-card {
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            background: #ffffff;
            position: relative;
        }

        .payment-option-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .payment-option-card:hover {
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        .payment-option-card.selected {
            border-color: #2563eb;
            background: #eff6ff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.12);
        }

        .payment-icon {
            font-size: 1.6rem;
            margin-bottom: 8px;
        }

        .payment-title {
            font-weight: 700;
            font-size: 0.88rem;
            color: #0f172a;
        }

        .payment-desc {
            font-size: 0.72rem;
            color: #64748b;
            margin-top: 4px;
        }

        .payment-details-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            margin-top: 16px;
        }

        /* Order Summary Side Bar */
        .summary-card {
            background: #ffffff;
            border-radius: 28px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            border: 1px solid #e2e8f0;
            position: sticky;
            top: 100px;
        }

        .summary-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f1f5f9;
        }

        .cart-items-summary {
            max-height: 280px;
            overflow-y: auto;
            margin-bottom: 20px;
            padding-right: 6px;
        }

        .cart-items-summary::-webkit-scrollbar {
            width: 4px;
        }

        .cart-items-summary::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .summary-item-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 0;
            border-bottom: 1px dashed #f1f5f9;
        }

        .summary-item-img {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            object-fit: cover;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            flex-shrink: 0;
        }

        .summary-item-info {
            flex-grow: 1;
            overflow: hidden;
        }

        .summary-item-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .summary-item-meta {
            font-size: 0.76rem;
            color: #64748b;
            margin-top: 2px;
        }

        .summary-item-price {
            font-size: 0.88rem;
            font-weight: 700;
            color: #0f172a;
            flex-shrink: 0;
        }

        /* Coupon Form */
        .coupon-box {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .coupon-input {
            flex-grow: 1;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.84rem;
            text-transform: uppercase;
            font-weight: 700;
            outline: none;
        }

        .coupon-btn {
            background: #0f172a;
            color: #ffffff;
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .coupon-btn:hover {
            background: #2563eb;
        }

        .coupon-notice {
            font-size: 0.75rem;
            color: #16a34a;
            font-weight: 600;
            margin-top: -12px;
            margin-bottom: 16px;
        }

        /* Summary Calculations */
        .calc-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.88rem;
            color: #64748b;
            margin-bottom: 10px;
        }

        .calc-row.discount {
            color: #16a34a;
            font-weight: 600;
        }

        .calc-row.grand-total {
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            padding-top: 14px;
            border-top: 2px solid #f1f5f9;
            margin-top: 14px;
        }

        .btn-place-order {
            width: 100%;
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 16px;
            padding: 16px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.2);
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-place-order:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(37, 99, 235, 0.3);
        }

        .free-shipping-badge {
            background: #f0fdf4;
            color: #16a34a;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 10px;
        }

        .alert-banner {
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 24px;
            font-size: 0.88rem;
            font-weight: 600;
        }

        .alert-banner.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="nav-container">
        <nav class="navbar">
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
                    <a href="{{ route('user.orders') }}" class="nav-link">My Orders</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- CHECKOUT MAIN CONTENT -->
    <div class="checkout-container">
        <div class="checkout-title-wrap">
            <h1 class="checkout-title">Complete Your Order</h1>
            <p class="checkout-subtitle">Secure express checkout — Fast shipping across India</p>
        </div>

        @if(session('error'))
            <div class="alert-banner error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-banner error">
                Please verify your information below. Fill in all required fields to complete checkout.
            </div>
        @endif

        <form action="{{ route('user.checkout.process') }}" method="POST" id="checkoutForm">
            @csrf

            <div class="checkout-grid">
                <!-- LEFT COLUMN: SHIPPING & PAYMENT -->
                <div>
                    <!-- SECTION 1: SHIPPING & CONTACT -->
                    <div class="checkout-card">
                        <div class="section-header">
                            <div class="step-badge">1</div>
                            <h2 class="section-title">Shipping & Contact Details</h2>
                        </div>

                        <div class="form-grid">
                            <div class="form-group full">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="customer_name" class="form-input" placeholder="e.g. Rahul Sharma" value="{{ old('customer_name', $user->name ?? '') }}" required>
                                @error('customer_name') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="customer_email" class="form-input" placeholder="rahul@example.com" value="{{ old('customer_email', $user->email ?? '') }}" required>
                                @error('customer_email') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" name="customer_phone" class="form-input" placeholder="+91 98765 43210" value="{{ old('customer_phone') }}" required>
                                @error('customer_phone') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group full">
                                <label class="form-label">Street Address *</label>
                                <input type="text" name="shipping_address" class="form-input" placeholder="Flat / House No., Building, Street Name, Area" value="{{ old('shipping_address') }}" required>
                                @error('shipping_address') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-input" placeholder="Mumbai" value="{{ old('city') }}" required>
                                @error('city') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">State *</label>
                                <input type="text" name="state" class="form-input" placeholder="Maharashtra" value="{{ old('state') }}" required>
                                @error('state') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">PIN Code *</label>
                                <input type="text" name="zip_code" class="form-input" placeholder="400001" value="{{ old('zip_code') }}" required>
                                @error('zip_code') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-input" value="India" readonly style="background: #f1f5f9; cursor: not-allowed;">
                            </div>

                            <div class="form-group full">
                                <label class="form-label">Delivery Notes (Optional)</label>
                                <input type="text" name="notes" class="form-input" placeholder="e.g. Leave at front door or call upon arrival" value="{{ old('notes') }}">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: PAYMENT METHOD -->
                    <div class="checkout-card">
                        <div class="section-header">
                            <div class="step-badge">2</div>
                            <h2 class="section-title">Select Payment Method</h2>
                        </div>

                        <div class="payment-options">
                            <label class="payment-option-card selected" id="opt-cod" onclick="selectPayment('cod')">
                                <input type="radio" name="payment_method" value="cod" checked>
                                <div class="payment-icon">💵</div>
                                <div class="payment-title">Cash on Delivery</div>
                                <div class="payment-desc">Pay cash when package arrives</div>
                            </label>

                            <label class="payment-option-card" id="opt-card" onclick="selectPayment('card')">
                                <input type="radio" name="payment_method" value="card">
                                <div class="payment-icon">💳</div>
                                <div class="payment-title">Credit / Debit Card</div>
                                <div class="payment-desc">Visa, Mastercard, RuPay</div>
                            </label>

                            <label class="payment-option-card" id="opt-upi" onclick="selectPayment('upi')">
                                <input type="radio" name="payment_method" value="upi">
                                <div class="payment-icon">📱</div>
                                <div class="payment-title">UPI / QR Code</div>
                                <div class="payment-desc">GPay, PhonePe, Paytm, BHIM</div>
                            </label>
                        </div>

                        <!-- CARD DETAILS BOX (HIDDEN BY DEFAULT) -->
                        <div class="payment-details-box" id="cardDetailsBox" style="display: none;">
                            <div class="form-grid">
                                <div class="form-group full">
                                    <label class="form-label">Card Number</label>
                                    <input type="text" name="card_number" id="card_number" class="form-input" placeholder="4532 •••• •••• 8892" maxlength="19">
                                    @error('card_number') <div class="error-msg">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="text" name="card_expiry" id="card_expiry" class="form-input" placeholder="MM/YY" maxlength="5">
                                    @error('card_expiry') <div class="error-msg">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CVV Code</label>
                                    <input type="password" name="card_cvv" id="card_cvv" class="form-input" placeholder="123" maxlength="4">
                                    @error('card_cvv') <div class="error-msg">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- UPI DETAILS BOX (HIDDEN BY DEFAULT) -->
                        <div class="payment-details-box" id="upiDetailsBox" style="display: none;">
                            <div class="form-group full">
                                <label class="form-label">Virtual Payment Address (VPA / UPI ID)</label>
                                <input type="text" name="upi_id" id="upi_id" class="form-input" placeholder="username@upi or mobile@paytm">
                                @error('upi_id') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: ORDER SUMMARY -->
                <div>
                    <div class="summary-card">
                        <h2 class="summary-title">Order Summary</h2>

                        <div class="cart-items-summary">
                            @foreach($cartItems as $item)
                                <div class="summary-item-row">
                                    <img src="{{ $item->image_path ? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset($item->image_path)) : asset('uploads/products/placeholder.png') }}" class="summary-item-img" alt="{{ $item->title }}">
                                    <div class="summary-item-info">
                                        <div class="summary-item-name">{{ $item->title }}</div>
                                        <div class="summary-item-meta">Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 2) }}</div>
                                    </div>
                                    <div class="summary-item-price">
                                        ₹{{ number_format($item->price * $item->quantity, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- COUPON CODE SECTION -->
                        <div class="coupon-box">
                            <input type="text" id="couponInput" name="coupon_code" class="coupon-input" placeholder="Promo Code (e.g. UNCART10)" value="{{ old('coupon_code') }}">
                            <button type="button" class="coupon-btn" onclick="applyCoupon()">Apply</button>
                        </div>
                        <div id="couponNotice" class="coupon-notice" style="display: none;"></div>

                        <!-- CALCULATIONS -->
                        <div class="calc-row">
                            <span>Subtotal</span>
                            <span id="subtotalDisplay">₹{{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="calc-row discount" id="discountRow" style="display: none;">
                            <span>Promo Discount</span>
                            <span id="discountDisplay">-₹0.00</span>
                        </div>

                        <div class="calc-row">
                            <span>Shipping Fee</span>
                            <span id="shippingDisplay">
                                @if($shippingFee == 0)
                                    <span class="free-shipping-badge">FREE</span>
                                @else
                                    ₹{{ number_format($shippingFee, 2) }}
                                @endif
                            </span>
                        </div>

                        <div class="calc-row grand-total">
                            <span>Total Payable</span>
                            <span id="totalDisplay">₹{{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="btn-place-order">
                            <span>Place Order Now</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        let currentSubtotal = {{ $subtotal }};
        let currentDiscount = 0;

        function selectPayment(type) {
            document.querySelectorAll('.payment-option-card').forEach(card => card.classList.remove('selected'));
            document.getElementById('opt-' + type).classList.add('selected');
            document.querySelector(`input[value="${type}"]`).checked = true;

            const cardBox = document.getElementById('cardDetailsBox');
            const upiBox = document.getElementById('upiDetailsBox');

            cardBox.style.display = (type === 'card') ? 'block' : 'none';
            upiBox.style.display = (type === 'upi') ? 'block' : 'none';
        }

        function applyCoupon() {
            const input = document.getElementById('couponInput').value.trim().toUpperCase();
            const notice = document.getElementById('couponNotice');
            const discountRow = document.getElementById('discountRow');
            const discountDisplay = document.getElementById('discountDisplay');
            const shippingDisplay = document.getElementById('shippingDisplay');
            const totalDisplay = document.getElementById('totalDisplay');

            if (!input) {
                notice.style.display = 'none';
                currentDiscount = 0;
            } else if (input === 'UNCART10') {
                currentDiscount = Math.round(currentSubtotal * 0.10 * 100) / 100;
                notice.style.color = '#16a34a';
                notice.innerText = 'Promo code UNCART10 applied! (10% OFF)';
                notice.style.display = 'block';
            } else if (input === 'WELCOME50') {
                currentDiscount = Math.min(50, currentSubtotal);
                notice.style.color = '#16a34a';
                notice.innerText = 'Promo code WELCOME50 applied! (₹50 OFF)';
                notice.style.display = 'block';
            } else {
                currentDiscount = 0;
                notice.style.color = '#ef4444';
                notice.innerText = 'Invalid or expired promo code.';
                notice.style.display = 'block';
            }

            if (currentDiscount > 0) {
                discountRow.style.display = 'flex';
                discountDisplay.innerText = '-₹' + currentDiscount.toFixed(2);
            } else {
                discountRow.style.display = 'none';
            }

            let effectiveTotalAfterDiscount = currentSubtotal - currentDiscount;
            let shipping = (effectiveTotalAfterDiscount > 999) ? 0 : 99;

            if (shipping === 0) {
                shippingDisplay.innerHTML = '<span class="free-shipping-badge">FREE</span>';
            } else {
                shippingDisplay.innerText = '₹' + shipping.toFixed(2);
            }

            let grandTotal = Math.max(0, effectiveTotalAfterDiscount + shipping);
            totalDisplay.innerText = '₹' + grandTotal.toFixed(2);
        }
    </script>
</body>

</html>
