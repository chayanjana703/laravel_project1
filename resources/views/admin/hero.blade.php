<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Section Manager — UnCart Admin</title>
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
        .reveal.active { opacity: 1; transform: translateY(0) scale(1); }

        /* Dynamic Island Navbar Animations */
        @keyframes navSlideDown {
            from { opacity: 0; transform: translateY(-30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .nav-container { position: fixed; top: 18px; left: 0; right: 0; z-index: 1000; display: flex; justify-content: center; padding: 0 16px; pointer-events: none; }
        .navbar { pointer-events: auto; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); color: #0f172a; border-radius: 28px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(15, 23, 42, 0.06); transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1); position: relative; width: 840px; padding: 8px 16px; animation: navSlideDown 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
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

        .nav-links { display: flex; align-items: center; gap: 14px; }
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
        .navbar.expanded { width: 840px; border-radius: 28px; padding-bottom: 16px; }
        .navbar.expanded .expand-toggle { transform: rotate(180deg); }

        .nav-expanded-content { max-height: 0; opacity: 0; overflow: hidden; transition: max-height 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease; }
        .navbar.expanded .nav-expanded-content { max-height: 500px; opacity: 1; padding-top: 16px; }
        .drawer-grid { display: grid; grid-template-columns: 1.1fr 1fr; gap: 14px; }
        .drawer-section { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 12px; }

        .page-wrapper { width: 100%; max-width: 1760px; margin: 0 auto; padding: 100px 32px 60px; }

        .bento-table-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 0; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04); overflow: hidden; margin-bottom: 32px; }
        .table-responsive { width: 100%; overflow-x: auto; }
        .aura-table { width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; }
        .aura-table th { padding: 16px 20px; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
        .aura-table td { padding: 16px 20px; color: #0f172a; font-size: 0.88rem; font-weight: 600; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .aura-table tbody tr:hover { background: #f8fafc; }
        .aura-table tbody tr:last-child td { border-bottom: none; }

        .hero-thumb { width: 44px; height: 44px; border-radius: 10px; object-fit: cover; border: 1px solid #e2e8f0; background: #f8fafc; }
        .section-badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; }
        .section-badge.carousel { background: #eff6ff; color: #2563eb; }
        .section-badge.flash { background: #fef2f2; color: #ef4444; }
        .section-badge.exclusive { background: #f0fdf4; color: #16a34a; }

        .action-circle-btn { background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 6px 14px; border-radius: 10px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 4px; text-decoration: none; }
        .action-circle-btn:hover { background: #0f172a; color: #ffffff; border-color: #0f172a; }
        .action-circle-btn.delete { color: #ef4444; border-color: #fecaca; }
        .action-circle-btn.delete:hover { background: #dc2626; color: #ffffff; border-color: #dc2626; }

        /* Modal Styles */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(8px); z-index: 2000; display: flex; align-items: center; justify-content: center; padding: 20px; opacity: 0; visibility: hidden; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-card { background: #ffffff; border-radius: 28px; width: 100%; max-width: 640px; max-height: 90vh; overflow-y: auto; padding: 32px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25); transform: translateY(20px); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .modal-overlay.active .modal-card { transform: translateY(0); }
        
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 0.82rem; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input, .form-select { width: 100%; padding: 12px 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 0.9rem; font-weight: 600; color: #0f172a; outline: none; transition: border-color 0.2s ease; }
        .form-input:focus, .form-select:focus { border-color: #2563eb; background: #ffffff; }

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
                    <a href="{{ route('admin.categories.index') }}" class="nav-link">Categories</a>
                    <a href="{{ route('admin.hero.index') }}" class="nav-link active">Hero Section</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
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
                            <a href="{{ route('admin.hero.index') }}" class="profile-menu-link">✨ Hero Cards Control</a>
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
                            <a href="{{ route('admin.hero.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">✨ Storefront Hero Cards Manager</a>
                            <a href="{{ route('admin.users.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 700;">👥 Registered User Accounts</a>
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

    <!-- MAIN CONTENT -->
    <main class="page-wrapper">
        @if(session('success'))
            <div style="background: #dcfce7; border: 1px solid #bbf7d0; color: #15803d; padding: 14px 20px; border-radius: 16px; margin-bottom: 24px; font-weight: 700;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
            <div>
                <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.2rem; font-weight: 700; color: #0f172a;">Storefront Hero Cards Manager</h1>
                <p style="color: #64748b; font-size: 0.95rem; margin-top: 4px;">Control the featured carousel products, flash sale banners, and exclusive release cards on the main storefront index page.</p>
            </div>
            <button class="cart-btn" onclick="openAddHeroModal()" style="padding: 12px 20px; font-size: 0.9rem;">
                ✨ Add New Hero Card
            </button>
        </div>

        <!-- HERO CARDS TABLE -->
        <div class="bento-table-card reveal">
            <div class="table-responsive">
                <table class="aura-table">
                    <thead>
                        <tr>
                            <th>Card</th>
                            <th>Section Target</th>
                            <th>Title & Subtitle</th>
                            <th>Badge / Tag</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($heroCards as $card)
                            @php
                                $imgSrc = $card->image ? (\Illuminate\Support\Str::startsWith($card->image, ['http://', 'https://']) ? $card->image : asset($card->image)) : 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';
                            @endphp
                            <tr data-id="{{ $card->id }}"
                                data-section="{{ $card->section }}"
                                data-title="{{ $card->title }}"
                                data-subtitle="{{ $card->subtitle }}"
                                data-badge="{{ $card->badge }}"
                                data-price="{{ $card->price }}"
                                data-oldprice="{{ $card->old_price }}"
                                data-rating="{{ $card->rating }}"
                                data-image="{{ $card->image }}"
                                data-productid="{{ $card->product_id }}"
                                data-sortorder="{{ $card->sort_order }}"
                                data-status="{{ $card->status ? 1 : 0 }}">
                                <td>
                                    <img src="{{ $imgSrc }}" class="hero-thumb" alt="Card Image" onerror="this.src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80';">
                                </td>
                                <td>
                                    @if($card->section === 'hero_carousel')
                                        <span class="section-badge carousel">🎡 Left Carousel</span>
                                    @elseif($card->section === 'flash_sale')
                                        <span class="section-badge flash">⚡ Flash Sale Banner</span>
                                    @elseif($card->section === 'focus_card')
                                        <span class="section-badge carousel" style="background: #faf5ff; color: #9333ea;">🪑 Center Focus Card</span>
                                    @else
                                        <span class="section-badge exclusive">🔥 Exclusive Release</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">{{ $card->title }}</div>
                                    <div style="font-size: 0.78rem; color: #64748b;">{{ Str::limit($card->subtitle, 35) }}</div>
                                </td>
                                <td>
                                    <span style="font-size: 0.75rem; font-weight: 800; background: #f1f5f9; padding: 4px 8px; border-radius: 8px;">
                                        {{ $card->badge ?? 'Standard' }}
                                    </span>
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">₹{{ number_format($card->price, 2) }}</div>
                                    @if($card->old_price)
                                        <div style="font-size: 0.75rem; color: #94a3b8; text-decoration: line-through;">₹{{ number_format($card->old_price, 2) }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($card->status)
                                        <span style="color: #16a34a; font-weight: 800; font-size: 0.8rem;">● Active</span>
                                    @else
                                        <span style="color: #94a3b8; font-weight: 800; font-size: 0.8rem;">○ Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; gap: 8px;">
                                        <button class="action-circle-btn" onclick="editHeroCard(this)">✏️ Edit</button>
                                        <form action="{{ route('admin.hero.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Delete this hero card?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-circle-btn delete">🗑️ Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                                    ✨ No hero cards created yet. Click "Add New Hero Card" to get started!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ADD/EDIT HERO CARD MODAL -->
    <div class="modal-overlay" id="heroModal">
        <div class="modal-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700;" id="heroModalTitle">Add Hero Card</h3>
                <button onclick="closeHeroModal()" style="background: none; border: none; font-size: 1.4rem; cursor: pointer; color: #64748b;">✕</button>
            </div>

            <form id="heroForm" method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data">
                @csrf
                <div id="methodField"></div>

                <div class="form-group">
                    <label class="form-label">Hero Section Target</label>
                    <select name="section" id="hSection" class="form-select" required>
                        <option value="hero_carousel">Left Hero Carousel (Spotlight Card)</option>
                        <option value="flash_sale">Center Flash Sale Banner (Great Value Deals)</option>
                        <option value="exclusive_release">Center Bottom Exclusive Release Card</option>
                        <option value="focus_card">Center Focus Card (Bottom Right Product Card)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Card Title</label>
                    <input type="text" name="title" id="hTitle" class="form-input" placeholder="e.g. Sony WH-1000XM5 Headphones" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Subtitle / Description</label>
                    <input type="text" name="subtitle" id="hSubtitle" class="form-input" placeholder="e.g. Industry-leading Noise Cancellation">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group">
                        <label class="form-label">Badge Tag</label>
                        <input type="text" name="badge" id="hBadge" class="form-input" placeholder="e.g. FLASHSALE 50% OFF / Hot Pick">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Rating Text / Score</label>
                        <input type="text" name="rating" id="hRating" class="form-input" placeholder="e.g. 4.9 or 🏷️ 4.9 Rating" value="4.9">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group">
                        <label class="form-label">Display Price (₹)</label>
                        <input type="number" step="0.01" name="price" id="hPrice" class="form-input" placeholder="24999">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Old Price (₹)</label>
                        <input type="number" step="0.01" name="old_price" id="hOldPrice" class="form-input" placeholder="34999">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Card Image File</label>
                    <input type="file" name="image_file" class="form-input" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="form-label">OR Image Path / URL</label>
                    <input type="text" name="image" id="hImage" class="form-input" placeholder="e.g. uploads/products/product_1_1.jpg or https://...">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group">
                        <label class="form-label">Link to Database Product (Optional)</label>
                        <select name="product_id" id="hProductId" class="form-select">
                            <option value="">-- No Direct Product Link --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">#{{ $p->id }} - {{ $p->name }} (₹{{ number_format($p->price) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Display Sort Order</label>
                        <input type="number" name="sort_order" id="hSortOrder" class="form-input" value="1">
                    </div>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                    <input type="checkbox" name="status" id="hStatus" value="1" checked style="width: 18px; height: 18px; accent-color: #2563eb;">
                    <label for="hStatus" style="font-weight: 700; color: #0f172a; cursor: pointer;">Enable & Publish on Storefront Hero</label>
                </div>

                <button type="submit" class="cart-btn" style="width: 100%; padding: 14px; justify-content: center; margin-top: 14px; font-size: 0.95rem;">
                    💾 Save Hero Card
                </button>
            </form>
        </div>
    </div>

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

        function openAddHeroModal() {
            document.getElementById('heroModalTitle').innerText = "Add New Hero Card";
            document.getElementById('heroForm').action = "{{ route('admin.hero.store') }}";
            document.getElementById('methodField').innerHTML = "";
            document.getElementById('heroForm').reset();
            document.getElementById('hStatus').checked = true;
            document.getElementById('heroModal').classList.add('active');
        }

        function closeHeroModal() {
            document.getElementById('heroModal').classList.remove('active');
        }

        function editHeroCard(btn) {
            const tr = btn.closest('tr');
            const id = tr.dataset.id;

            document.getElementById('heroModalTitle').innerText = "Edit Hero Card #" + id;
            document.getElementById('heroForm').action = "{{ url('/admin/hero') }}/" + id;
            document.getElementById('methodField').innerHTML = '@method("PUT")';

            document.getElementById('hSection').value = tr.dataset.section || 'hero_carousel';
            document.getElementById('hTitle').value = tr.dataset.title || '';
            document.getElementById('hSubtitle').value = tr.dataset.subtitle || '';
            document.getElementById('hBadge').value = tr.dataset.badge || '';
            document.getElementById('hPrice').value = tr.dataset.price || '';
            document.getElementById('hOldPrice').value = tr.dataset.oldprice || '';
            document.getElementById('hRating').value = tr.dataset.rating || '4.9';
            document.getElementById('hImage').value = tr.dataset.image || '';
            document.getElementById('hProductId').value = tr.dataset.productid || '';
            document.getElementById('hSortOrder').value = tr.dataset.sortorder || '1';
            document.getElementById('hStatus').checked = tr.dataset.status === '1';

            document.getElementById('heroModal').classList.add('active');
        }

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
