<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Directory — UnCart Admin</title>
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

        /* Dynamic Island Navbar Animations */
        @keyframes navSlideDown {
            from { opacity: 0; transform: translateY(-30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .nav-container { position: fixed; top: 18px; left: 0; right: 0; z-index: 1000; display: flex; justify-content: center; padding: 0 16px; pointer-events: none; }
        .navbar { pointer-events: auto; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); color: #0f172a; border-radius: 28px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(15, 23, 42, 0.06); transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1); position: relative; width: 780px; padding: 8px 16px; animation: navSlideDown 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .navbar:hover { box-shadow: 0 25px 50px rgba(37, 99, 235, 0.12), 0 0 0 1px rgba(37, 99, 235, 0.15); }
        .nav-header { display: flex; align-items: center; justify-content: space-between; height: 42px; cursor: pointer; user-select: none; }
        .nav-left { display: flex; align-items: center; gap: 10px; text-decoration: none; transition: transform 0.25s ease; }
        .nav-left:hover { transform: translateX(2px); }
        .brand-icon { width: 32px; height: 32px; background: #0f172a; border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15); transition: all 0.3s ease; }
        .nav-left:hover .brand-icon { background: #2563eb; transform: rotate(-6deg) scale(1.08); box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3); }
        .brand-icon svg { width: 18px; height: 18px; fill: #ffffff; }
        .brand-name { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.05rem; letter-spacing: 0.5px; color: #0f172a; }
        .admin-tag { background: #0f172a; color: #ffffff; font-size: 0.65rem; font-weight: 800; padding: 3px 8px; border-radius: 20px; text-transform: uppercase; transition: background 0.25s ease; }
        .nav-left:hover .admin-tag { background: #2563eb; }

        .nav-links { display: flex; align-items: center; gap: 16px; }
        .nav-link { color: #64748b; font-size: 0.85rem; font-weight: 600; text-decoration: none; position: relative; padding: 4px 2px; transition: color 0.25s ease, transform 0.2s ease; }
        .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 50%; width: 0; height: 2px; background: linear-gradient(90deg, #2563eb, #3b82f6); border-radius: 4px; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); transform: translateX(-50%); }
        .nav-link:hover { color: #2563eb; transform: translateY(-1px); }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link.active { color: #2563eb; font-weight: 700; }

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

        .bento-table-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 0; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04); overflow: hidden; }
        .table-responsive { width: 100%; overflow-x: auto; }
        .aura-table { width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; }
        .aura-table th { padding: 18px 24px; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
        .aura-table td { padding: 18px 24px; color: #0f172a; font-size: 0.88rem; font-weight: 600; border-bottom: 1px solid #f1f5f9; vertical-align: middle; transition: background 0.2s ease; }
        .aura-table tbody tr { transition: all 0.2s ease; }
        .aura-table tbody tr:hover { background: #f8fafc; }
        .aura-table tbody tr:last-child td { border-bottom: none; }

        .user-avatar { width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: #ffffff; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; box-shadow: 0 4px 10px rgba(15, 23, 42, 0.12); flex-shrink: 0; }
        .user-badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; background: #f1f5f9; color: #475569; }
        .user-badge.spending { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
        .action-circle-btn { background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 8px 18px; border-radius: 12px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1); display: inline-flex; align-items: center; gap: 6px; }
        .action-circle-btn:hover { background: #0f172a; color: #ffffff; border-color: #0f172a; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15); transform: translateY(-1px); }

        @media (max-width: 900px) {
            .nav-container { top: auto !important; bottom: 16px !important; }
            .navbar { width: 100% !important; border-radius: 28px; }
            .nav-links { display: none; }
            .page-wrapper { padding: 24px 16px 120px !important; }
        }
    </style>
</head>
<body>

    <!-- DYNAMIC ISLAND NAVBAR (EXACT MATCH TO ADMIN INDEX) -->
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
                    <a href="{{ route('admin.products.index') }}" class="nav-link">Products</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link active">Users</a>
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
        @if(session('success'))
            <div style="background: #dcfce7; border: 1px solid #bbf7d0; color: #15803d; padding: 14px 20px; border-radius: 16px; margin-bottom: 24px; font-weight: 700;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="reveal" style="margin-bottom: 28px;">
            <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.4rem; font-weight: 700; color: #0f172a;">Customer Directory</h1>
            <p style="color: #64748b; font-size: 0.95rem; margin-top: 4px;">Registered accounts & user management</p>
        </div>

        <div class="bento-table-card reveal">
            <div class="table-responsive">
                <table class="aura-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Email Address</th>
                            <th>Joined Date</th>
                            <th>Orders</th>
                            <th>Total Spent</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

@forelse($users as $user)

<tr>

    <td>
        <div style="display: flex; align-items: center; gap: 12px;">
            <span class="user-avatar">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </span>
            <div style="display: flex; flex-direction: column;">
                <span style="font-weight: 700; color: #0f172a; font-size: 0.92rem;">{{ $user->name }}</span>
                <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 500;">User #{{ $user->id }}</span>
            </div>
        </div>
    </td>

    <td>
        <span style="color: #475569; font-weight: 600; font-size: 0.88rem;">{{ $user->email }}</span>
    </td>

    <td>
        <span style="display: inline-flex; align-items: center; gap: 6px; color: #64748b; font-size: 0.85rem; font-weight: 600;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
        </span>
    </td>

    <td>
        <span class="user-badge">0 Orders</span>
    </td>

    <td>
        <span class="user-badge spending">₹0</span>
    </td>

    <td style="text-align: right;">
        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete user {{ addslashes($user->name) }}?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-circle-btn" style="color: #ef4444; border-color: #fecaca; background: #fef2f2;">
                <span>Delete Account</span>
            </button>
        </form>
    </td>

</tr>

@empty

<tr>
    <td colspan="6" style="text-align: center; padding: 48px 24px; color: #64748b;">
        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            <span style="font-weight: 700; font-size: 1rem; color: #334155;">No Customers Registered Yet</span>
            <span style="font-size: 0.85rem; color: #94a3b8;">When new users register, they will show up here.</span>
        </div>
    </td>
</tr>

@endforelse

</tbody>
                </table>
            </div>
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
