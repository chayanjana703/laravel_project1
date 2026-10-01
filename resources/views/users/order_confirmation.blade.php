<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed — UnCart Marketplace</title>
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

        /* NAVBAR */
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
            position: relative;
            width: 660px;
            padding: 8px 14px;
        }

        .nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 42px;
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
        }

        .confirmation-container {
            max-width: 840px;
            margin: 0 auto;
            padding: 100px 20px 60px;
        }

        .success-card {
            background: #ffffff;
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04);
            border: 1px solid #e2e8f0;
            text-align: center;
            margin-bottom: 24px;
        }

        .check-circle {
            width: 80px;
            height: 80px;
            background: #f0fdf4;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 2.2rem;
            border: 2px solid #bbf7d0;
            box-shadow: 0 10px 25px rgba(22, 163, 74, 0.15);
        }

        .conf-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .conf-subtitle {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .order-number-badge {
            display: inline-block;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 8px 18px;
            border-radius: 20px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: #0f172a;
            letter-spacing: 0.5px;
        }

        /* Order Details Card */
        .details-card {
            background: #ffffff;
            border-radius: 28px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .card-header {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
        }

        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-block {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 18px;
            padding: 16px;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 0.92rem;
            font-weight: 700;
            color: #0f172a;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-badge.paid { background: #f0fdf4; color: #16a34a; }
        .status-badge.pending { background: #fffbeb; color: #d97706; }

        /* Purchased Items List */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th {
            text-align: left;
            padding: 10px;
            font-size: 0.78rem;
            color: #64748b;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
        }

        .items-table td {
            padding: 14px 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #0f172a;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .item-thumb {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
            background: #f1f5f9;
            margin-right: 10px;
            vertical-align: middle;
        }

        .receipt-summary {
            max-width: 320px;
            margin-left: auto;
            padding-top: 10px;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.88rem;
            color: #64748b;
            margin-bottom: 8px;
        }

        .receipt-row.total {
            font-size: 1.1rem;
            font-weight: 800;
            color: #0f172a;
            border-top: 2px solid #f1f5f9;
            padding-top: 10px;
            margin-top: 10px;
        }

        .actions-group {
            display: flex;
            gap: 14px;
            justify-content: center;
            margin-top: 32px;
        }

        .btn-primary {
            background: #0f172a;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #2563eb;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #0f172a;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 0.92rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
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
                    <a href="{{ route('user.orders') }}" class="nav-link">My Orders</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- MAIN CONFIRMATION CONTENT -->
    <div class="confirmation-container">
        <div class="success-card">
            <div class="check-circle">✓</div>
            <h1 class="conf-title">Thank You For Your Order!</h1>
            <p class="conf-subtitle">We have received your order and are processing it for shipment.</p>
            <div class="order-number-badge">Order Number: {{ $order->order_number }}</div>
        </div>

        <div class="details-card">
            <h2 class="card-header">Order & Shipping Details</h2>

            <div class="info-grid">
                <div class="info-block">
                    <div class="info-label">Customer Info</div>
                    <div class="info-value">{{ $order->customer_name }}</div>
                    <div style="font-size: 0.82rem; color: #64748b; margin-top: 2px;">{{ $order->customer_email }}</div>
                    <div style="font-size: 0.82rem; color: #64748b;">{{ $order->customer_phone }}</div>
                </div>

                <div class="info-block">
                    <div class="info-label">Shipping Address</div>
                    <div class="info-value" style="font-size: 0.85rem; font-weight: 600;">
                        {{ $order->shipping_address }}<br>
                        {{ $order->city }}, {{ $order->state }} - {{ $order->zip_code }}<br>
                        {{ $order->country }}
                    </div>
                </div>

                <div class="info-block">
                    <div class="info-label">Payment Method</div>
                    <div class="info-value" style="text-transform: uppercase;">{{ $order->payment_method }}</div>
                    <div style="margin-top: 4px;">
                        <span class="status-badge {{ $order->payment_status }}">
                            Payment {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>

                <div class="info-block">
                    <div class="info-label">Order Status</div>
                    <div class="info-value" style="text-transform: capitalize;">{{ $order->order_status }}</div>
                    <div style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Placed on {{ $order->created_at->format('M d, Y • h:i A') }}</div>
                </div>
            </div>

            <h2 class="card-header">Items Purchased</h2>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->image_path ? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset($item->image_path)) : asset('uploads/products/placeholder.png') }}" class="item-thumb" alt="">
                                {{ $item->product_title }}
                            </td>
                            <td>₹{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td style="text-align: right;">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="receipt-summary">
                <div class="receipt-row">
                    <span>Subtotal</span>
                    <span>₹{{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if($order->discount > 0)
                    <div class="receipt-row" style="color: #16a34a;">
                        <span>Discount ({{ $order->coupon_code }})</span>
                        <span>-₹{{ number_format($order->discount, 2) }}</span>
                    </div>
                @endif
                <div class="receipt-row">
                    <span>Shipping Fee</span>
                    <span>{{ $order->shipping_fee == 0 ? 'FREE' : '₹' . number_format($order->shipping_fee, 2) }}</span>
                </div>
                <div class="receipt-row total">
                    <span>Total Paid</span>
                    <span>₹{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

            <div class="actions-group">
                <a href="{{ route('user.index') }}" class="btn-primary">Continue Shopping</a>
                <a href="{{ route('user.orders') }}" class="btn-secondary">View Order History</a>
            </div>
        </div>
    </div>

</body>

</html>
