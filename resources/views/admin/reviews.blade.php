<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews Manager — UnCart Admin</title>
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

        .rating-badge { background: #16a34a; color: #ffffff; padding: 4px 10px; border-radius: 8px; font-size: 0.78rem; font-weight: 800; display: inline-flex; align-items: center; gap: 4px; }
        .action-circle-btn { background: #ffffff; border: 1px solid #fecaca; color: #ef4444; padding: 8px 18px; border-radius: 12px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1); display: inline-flex; align-items: center; gap: 6px; }
        .action-circle-btn:hover { background: #dc2626; color: #ffffff; border-color: #dc2626; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15); transform: translateY(-1px); }

        /* Delete Reason Modal */
        .modal { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 2000; padding: 20px; }
        .modal.active { display: flex; }
        .modal-card { background: #ffffff; border-radius: 24px; padding: 28px; width: 100%; max-width: 500px; box-shadow: 0 25px 50px rgba(15, 23, 42, 0.2); animation: modalIn 0.25s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95) translateY(8px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .modal-header h3 { font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; font-weight: 700; color: #0f172a; }
        .modal-close-btn { background: #f1f5f9; border: none; font-size: 1.1rem; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: #64748b; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
        .modal-close-btn:hover { background: #e2e8f0; color: #0f172a; }
        .review-info-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 12px 16px; margin-bottom: 18px; font-size: 0.85rem; color: #475569; }
        .form-label { display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 8px; }
        .form-textarea { width: 100%; padding: 12px 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; font-size: 0.88rem; font-weight: 500; font-family: inherit; color: #0f172a; outline: none; transition: border-color 0.2s ease; resize: vertical; min-height: 95px; }
        .form-textarea:focus { border-color: #ef4444; background: #ffffff; }
        .quick-reasons { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 8px; margin-bottom: 18px; }
        .quick-reason-chip { font-size: 0.75rem; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 20px; padding: 4px 10px; cursor: pointer; color: #475569; font-weight: 600; transition: all 0.15s; }
        .quick-reason-chip:hover { background: #fee2e2; border-color: #fca5a5; color: #dc2626; }
        .modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px; }
        .modal-cancel-btn { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px 18px; font-size: 0.85rem; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .modal-cancel-btn:hover { background: #e2e8f0; color: #0f172a; }
        .modal-confirm-btn { background: #ef4444; color: #ffffff; border: none; border-radius: 12px; padding: 10px 20px; font-size: 0.85rem; font-weight: 700; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .modal-confirm-btn:hover { background: #dc2626; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25); }

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
                <a href="{{ route('admin.index') }}" class="nav-left">
                    <div class="brand-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div>
                    <span class="brand-name">UnCart</span>
                    <span class="admin-tag">ADMIN</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('admin.index') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link">Products</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                    <a href="{{ route('admin.reviews.index') }}" class="nav-link active">Reviews</a>
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

    <main class="page-wrapper">
        @if(session('success'))
            <div style="background: #dcfce7; border: 1px solid #bbf7d0; color: #15803d; padding: 14px 20px; border-radius: 16px; margin-bottom: 24px; font-weight: 700;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: #fee2e2; border: 1px solid #fecaca; color: #dc2626; padding: 14px 20px; border-radius: 16px; margin-bottom: 24px; font-weight: 700;">
                ⚠️ {{ $errors->first() }}
            </div>
        @endif

        <div class="reveal" style="margin-bottom: 28px;">
            <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.4rem; font-weight: 700; color: #0f172a;">Customer Reviews Manager</h1>
            <p style="color: #64748b; font-size: 0.95rem; margin-top: 4px;">Monitor and moderate customer ratings and product feedback</p>
        </div>

        <div class="bento-table-card reveal">
            <div class="table-responsive">
                <table class="aura-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Reviewer</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Submitted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $rev)
                            <tr>
                                <td><strong>#{{ $rev->id }}</strong></td>
                                <td>{{ $rev->product->name ?? 'Product #'.$rev->product_id }}</td>
                                <td>{{ $rev->user_name }}</td>
                                <td><span class="rating-badge">{{ $rev->rating }} ★</span></td>
                                <td style="max-width: 320px; word-break: break-word;">"{{ $rev->comment }}"</td>
                                <td>{{ $rev->created_at ? $rev->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>
                                    <button type="button" 
                                            class="action-circle-btn" 
                                            onclick="openDeleteModal({{ $rev->id }}, '{{ addslashes($rev->user_name) }}', '{{ addslashes($rev->product->name ?? 'Product #'.$rev->product_id) }}', '{{ addslashes(Str::limit($rev->comment, 60)) }}')">
                                        🗑️ Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                                    ⭐ No customer reviews recorded yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Delete Review Confirmation Modal With Reason -->
    <div class="modal" id="deleteReviewModal">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Delete Review</h3>
                <button type="button" class="modal-close-btn" onclick="closeDeleteModal()">✕</button>
            </div>

            <div class="review-info-box">
                <div style="font-weight: 700; color: #0f172a; margin-bottom: 3px;" id="modalReviewerProduct"></div>
                <div style="font-style: italic; color: #64748b; font-size: 0.82rem;" id="modalReviewSnippet"></div>
            </div>

            <form id="deleteReviewForm" method="POST" action="">
                @csrf
                @method('DELETE')

                <label class="form-label" for="deleteReasonInput">
                    Reason for Deletion <span style="color: #ef4444;">*</span>
                </label>
                <textarea name="reason" 
                          id="deleteReasonInput" 
                          class="form-textarea" 
                          placeholder="e.g. Inappropriate language, spam advertisement, irrelevant feedback, abuse..." 
                          required minlength="3"></textarea>

                <div style="font-size: 0.75rem; color: #64748b; margin-top: 6px; font-weight: 600;">Quick reason suggestions:</div>
                <div class="quick-reasons">
                    <span class="quick-reason-chip" onclick="setQuickReason('Spam / Promotional advertisement')">📢 Spam</span>
                    <span class="quick-reason-chip" onclick="setQuickReason('Inappropriate or abusive language')">🚫 Abusive Language</span>
                    <span class="quick-reason-chip" onclick="setQuickReason('Fake or misleading review')">⚠️ Fake Review</span>
                    <span class="quick-reason-chip" onclick="setQuickReason('Irrelevant to the product')">🔗 Irrelevant</span>
                    <span class="quick-reason-chip" onclick="setQuickReason('Customer requested removal')">👤 User Request</span>
                </div>

                <div class="modal-actions">
                    <button type="button" class="modal-cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="modal-confirm-btn">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        Confirm Delete
                    </button>
                </div>
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

        function openDeleteModal(id, reviewer, product, snippet) {
            const form = document.getElementById('deleteReviewForm');
            form.action = "{{ url('/admin/reviews') }}/" + id;

            document.getElementById('modalReviewerProduct').innerText = reviewer + ' on "' + product + '"';
            document.getElementById('modalReviewSnippet').innerText = '“' + snippet + '”';

            const reasonInput = document.getElementById('deleteReasonInput');
            reasonInput.value = '';

            document.getElementById('deleteReviewModal').classList.add('active');
            setTimeout(() => reasonInput.focus(), 150);
        }

        function closeDeleteModal() {
            document.getElementById('deleteReviewModal').classList.remove('active');
        }

        function setQuickReason(text) {
            const reasonInput = document.getElementById('deleteReasonInput');
            reasonInput.value = text;
            reasonInput.focus();
        }

        // Close modal when clicking outside modal-card
        document.getElementById('deleteReviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
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
