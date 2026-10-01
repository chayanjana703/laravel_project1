<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .nav-link.active {
            color: #2563eb;
        }

        .orders-container {
            max-width: 980px;
            margin: 0 auto;
            padding: 100px 20px 60px;
        }

        .page-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 24px;
        }

        .empty-orders {
            background: #ffffff;
            border-radius: 28px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            border: 1px solid #e2e8f0;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 16px;
        }

        .btn-shop {
            display: inline-block;
            background: #0f172a;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.88rem;
            margin-top: 16px;
        }

        .order-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 16px;
        }

        .order-num {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            color: #0f172a;
        }

        .order-date {
            font-size: 0.8rem;
            color: #64748b;
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-pill.processing { background: #eff6ff; color: #2563eb; }
        .status-pill.shipped { background: #f0fdf4; color: #16a34a; }
        .status-pill.delivered { background: #f0fdf4; color: #15803d; }
        .status-pill.cancelled { background: #fef2f2; color: #b91c1c; }

        .order-items-preview {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            overflow-x: auto;
        }

        .item-preview-thumb {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            background: #f1f5f9;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 14px;
            border-top: 1px solid #f8fafc;
        }

        .order-price {
            font-size: 1.1rem;
            font-weight: 800;
            color: #0f172a;
        }

        .btn-view {
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.88rem;
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
                    <a href="{{ route('user.orders') }}" class="nav-link active">My Orders</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- MAIN ORDERS LIST CONTENT -->
    <div class="orders-container">
        <h1 class="page-title">My Order History</h1>

        @if($orders->isEmpty())
            <div class="empty-orders">
                <div class="empty-icon">📦</div>
                <h2>No Orders Placed Yet</h2>
                <p style="color: #64748b; margin-top: 6px;">You have not placed any orders yet. Discover our collection and place your first order!</p>
                <a href="{{ route('user.index') }}" class="btn-shop">Explore Products</a>
            </div>
        @else
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-num">{{ $order->order_number }}</div>
                            <div class="order-date">Placed on {{ $order->created_at->format('M d, Y • h:i A') }}</div>
                        </div>
                        <div>
                            <span class="status-pill {{ $order->order_status }}">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </div>
                    </div>

                    <div class="order-items-preview">
                        @foreach($order->items as $item)
                            <img src="{{ $item->image_path ? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset($item->image_path)) : asset('uploads/products/placeholder.png') }}" class="item-preview-thumb" title="{{ $item->product_title }} (Qty: {{ $item->quantity }})" alt="">
                        @endforeach
                    </div>

                    <div class="order-footer">
                        <div>
                            <span style="font-size: 0.8rem; color: #64748b;">Total Amount:</span>
                            <span class="order-price">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <a href="{{ route('user.order.confirmation', $order->order_number) }}" class="btn-view">View Details →</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</body>

</html>
