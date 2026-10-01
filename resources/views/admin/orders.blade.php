<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders & Dispatch — UnCart Admin</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: #f1f5f9;
            color: #0f172a;
            overflow-x: hidden;
            width: 100%;
        }

        .nav-container { position: fixed; top: 18px; left: 0; right: 0; z-index: 1000; display: flex; justify-content: center; padding: 0 16px; pointer-events: none; }
        .navbar { pointer-events: auto; background: rgba(255, 255, 255, 0.94); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); color: #0f172a; border-radius: 28px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(15, 23, 42, 0.08); transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1); position: relative; width: 780px; padding: 8px 16px; }
        .nav-header { display: flex; align-items: center; justify-content: space-between; height: 42px; cursor: pointer; user-select: none; }
        .nav-left { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 32px; height: 32px; background: #0f172a; border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15); }
        .brand-icon svg { width: 18px; height: 18px; fill: #ffffff; }
        .brand-name { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.05rem; letter-spacing: 0.5px; color: #0f172a; }
        .admin-tag { background: #0f172a; color: #ffffff; font-size: 0.65rem; font-weight: 800; padding: 3px 8px; border-radius: 20px; text-transform: uppercase; }

        .nav-links { display: flex; align-items: center; gap: 16px; }
        .nav-link { color: #64748b; font-size: 0.85rem; font-weight: 600; text-decoration: none; transition: color 0.2s ease; }
        .nav-link:hover, .nav-link.active { color: #2563eb; }

        .profile-dropdown-wrapper { position: relative; display: inline-block; }
        .profile-icon-btn { background: #f1f5f9; color: #0f172a; border: 1px solid #e2e8f0; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1); }
        .profile-dropdown-wrapper:hover .profile-icon-btn, .profile-icon-btn:hover { background: #0f172a; color: #ffffff; border-color: #0f172a; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15); }
        .profile-menu { position: absolute; top: calc(100% + 10px); right: 0; width: 220px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 12px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(15, 23, 42, 0.04); opacity: 0; visibility: hidden; transform: translateY(8px); transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1); z-index: 1001; }
        .profile-dropdown-wrapper:hover .profile-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        .profile-menu-header { padding: 6px 8px 10px; border-bottom: 1px solid #f1f5f9; margin-bottom: 8px; }
        .profile-menu-header .user-name { font-weight: 700; font-size: 0.9rem; color: #0f172a; }
        .profile-menu-header .user-desc { font-size: 0.75rem; color: #64748b; }
        .profile-menu-link { display: flex; align-items: center; gap: 8px; padding: 8px 10px; color: #475569; font-size: 0.82rem; font-weight: 600; text-decoration: none; border-radius: 10px; transition: all 0.15s ease; }
        .profile-menu-link:hover { background: #f8fafc; color: #0f172a; }

        .cart-btn { background: #0f172a; color: #ffffff; border: none; border-radius: 20px; padding: 7px 14px; font-size: 0.82rem; font-weight: 700; display: flex; align-items: center; gap: 6px; cursor: pointer; transition: transform 0.2s ease, background 0.2s ease; }
        .cart-btn:hover { transform: scale(1.04); background: #1e293b; }

        .expand-toggle { background: #f1f5f9; border: none; color: #0f172a; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s ease, transform 0.4s ease; }
        .navbar.expanded { width: 800px; border-radius: 28px; padding-bottom: 16px; }
        .navbar.expanded .expand-toggle { transform: rotate(180deg); }

        .nav-expanded-content { max-height: 0; opacity: 0; overflow: hidden; transition: max-height 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease; }
        .navbar.expanded .nav-expanded-content { max-height: 500px; opacity: 1; padding-top: 16px; }
        .drawer-grid { display: grid; grid-template-columns: 1.1fr 1fr; gap: 14px; }
        .drawer-section { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 12px; }

        .page-wrapper { width: 100%; max-width: 1760px; margin: 0 auto; padding: 100px 32px 60px; }

        .bento-table-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 32px; padding: 32px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.03); }
        .aura-table { width: 100%; border-collapse: collapse; text-align: left; }
        .aura-table th { padding: 14px; color: #64748b; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; border-bottom: 1.5px solid #f1f5f9; }
        .aura-table td { padding: 16px 14px; color: #0f172a; font-size: 0.9rem; font-weight: 600; border-bottom: 1px solid #f8fafc; vertical-align: middle; }

        .table-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .table-badge.success { background: #f0fdf4; color: #16a34a; }
        .table-badge.pending { background: #fffbeb; color: #d97706; }
        .table-badge.info { background: #eff6ff; color: #2563eb; }
        .table-badge.danger { background: #fef2f2; color: #ef4444; }

        .action-circle-btn { background: #f1f5f9; border: 1px solid #e2e8f0; color: #0f172a; padding: 8px 16px; border-radius: 14px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease; }
        .action-circle-btn:hover { background: #0f172a; color: #ffffff; border-color: #0f172a; }

        .status-select {
            padding: 6px 10px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            font-size: 0.8rem;
            font-weight: 600;
            background: #ffffff;
            color: #0f172a;
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 24px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        @media (max-width: 900px) {
            .nav-container { top: auto !important; bottom: 16px !important; }
            .navbar { width: 100% !important; border-radius: 28px; }
            .nav-links { display: none; }
            .page-wrapper { padding: 24px 16px 120px !important; }
        }
    </style>
</head>
<body>

    <!-- DYNAMIC ISLAND NAVBAR -->
    <div class="nav-container">
        <nav class="navbar" id="dynamicNavbar">
            <div class="nav-header">
                <a href="{{ route('admin.index') }}" class="nav-left">
                    <div class="brand-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div>
                    <span class="brand-name">UnCart</span>
                    <span class="admin-tag">ADMIN</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('admin.index') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link">Products</a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link active">Orders</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link">Customers</a>
                    <a href="{{ route('admin.settings') }}" class="nav-link">Settings</a>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <div class="profile-dropdown-wrapper">
                        <button class="profile-icon-btn" aria-label="User Account">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </button>
                        <div class="profile-menu">
                            <div class="profile-menu-header">
                                <div class="user-name">Admin Account</div>
                                <div class="user-desc">Store Master Controls</div>
                            </div>
                            <a href="{{ route('user.index') }}" class="profile-menu-link">🌐 Storefront</a>
                            <a href="{{ route('admin.settings') }}" class="profile-menu-link">⚙️ Site Settings</a>
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
                            <a href="{{ route('admin.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">📊 Main Dashboard Overview</a>
                            <a href="{{ route('admin.products.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">📦 Products Catalog Manager</a>
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
        <div style="margin-bottom: 28px;">
            <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.4rem; font-weight: 700; color: #0f172a;">Orders & Fulfillment</h1>
            <p style="color: #64748b; font-size: 0.95rem; margin-top: 4px;">Live customer orders, shipping addresses & status updates</p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bento-table-card">
            @if(!isset($orders) || $orders->isEmpty())
                <div style="text-align: center; padding: 40px; color: #64748b;">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">📦</div>
                    <div style="font-weight: 700; font-size: 1.1rem; color: #0f172a;">No orders received yet</div>
                    <p style="font-size: 0.88rem; margin-top: 4px;">Orders placed by users on the store checkout page will appear here live.</p>
                </div>
            @else
                <table class="aura-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Shipping Address</th>
                            <th>Items</th>
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><strong>{{ $order->order_number }}</strong><br><span style="font-size: 0.72rem; color: #64748b;">{{ $order->created_at->format('M d, Y') }}</span></td>
                                <td>
                                    {{ $order->customer_name }}<br>
                                    <span style="font-size: 0.75rem; color: #64748b;">{{ $order->customer_email }}</span><br>
                                    <span style="font-size: 0.75rem; color: #64748b;">{{ $order->customer_phone }}</span>
                                </td>
                                <td style="max-width: 200px; font-size: 0.82rem; color: #475569;">
                                    {{ $order->shipping_address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->zip_code }}
                                </td>
                                <td>
                                    <span style="font-weight: 700; color: #0f172a;">{{ $order->items->sum('quantity') }} items</span>
                                    <div style="font-size: 0.75rem; color: #64748b;">
                                        @foreach($order->items->take(2) as $item)
                                            • {{ Str::limit($item->product_title, 18) }}<br>
                                        @endforeach
                                    </div>
                                </td>
                                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="table-badge {{ $order->payment_status === 'paid' ? 'success' : 'pending' }}">
                                        {{ strtoupper($order->payment_method) }}: {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $badgeClass = 'info';
                                        if ($order->order_status === 'delivered') $badgeClass = 'success';
                                        elseif ($order->order_status === 'cancelled') $badgeClass = 'danger';
                                        elseif ($order->order_status === 'processing') $badgeClass = 'pending';
                                    @endphp
                                    <span class="table-badge {{ $badgeClass }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 6px;">
                                        @csrf
                                        @method('PUT')
                                        <select name="order_status" class="status-select">
                                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <select name="payment_status" class="status-select">
                                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Payment Pending</option>
                                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Payment Paid</option>
                                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Payment Failed</option>
                                        </select>
                                        <button type="submit" class="action-circle-btn" style="padding: 4px 8px; font-size: 0.75rem;">Save</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
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
    </script>
</body>
</html>
