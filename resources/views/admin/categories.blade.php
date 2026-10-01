<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories & Sections Manager — UnCart Admin</title>
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
        .navbar { pointer-events: auto; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); color: #0f172a; border-radius: 28px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(15, 23, 42, 0.06); transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1); position: relative; width: 880px; padding: 8px 16px; animation: navSlideDown 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
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

        .cart-btn { background: #0f172a; color: #ffffff; border: none; border-radius: 20px; padding: 7px 14px; font-size: 0.82rem; font-weight: 700; display: flex; align-items: center; gap: 6px; cursor: pointer; transition: transform 0.2s ease, background 0.2s ease; }
        .cart-btn:hover { transform: scale(1.04); background: #1e293b; }

        .page-wrapper { width: 100%; max-width: 1760px; margin: 0 auto; padding: 100px 32px 60px; }

        .bento-table-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 0; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04); overflow: hidden; margin-bottom: 32px; }
        .table-responsive { width: 100%; overflow-x: auto; }
        .aura-table { width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; }
        .aura-table th { padding: 16px 20px; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
        .aura-table td { padding: 16px 20px; color: #0f172a; font-size: 0.88rem; font-weight: 600; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .aura-table tbody tr:hover { background: #f8fafc; }

        .action-circle-btn { background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 6px 14px; border-radius: 10px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 4px; text-decoration: none; }
        .action-circle-btn:hover { background: #0f172a; color: #ffffff; border-color: #0f172a; }
        .action-circle-btn.delete { color: #ef4444; border-color: #fecaca; }
        .action-circle-btn.delete:hover { background: #dc2626; color: #ffffff; border-color: #dc2626; }

        /* Modal Styles */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(8px); z-index: 2000; display: flex; align-items: center; justify-content: center; padding: 20px; opacity: 0; visibility: hidden; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-card { background: #ffffff; border-radius: 28px; width: 100%; max-width: 580px; max-height: 90vh; overflow-y: auto; padding: 32px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25); transform: translateY(20px); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .modal-overlay.active .modal-card { transform: translateY(0); }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 0.82rem; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input { width: 100%; padding: 12px 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 0.9rem; font-weight: 600; color: #0f172a; outline: none; transition: border-color 0.2s ease; }
        .form-input:focus { border-color: #2563eb; background: #ffffff; }
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
                    <a href="{{ route('admin.categories.index') }}" class="nav-link active">Categories</a>
                    <a href="{{ route('admin.hero.index') }}" class="nav-link">Hero Section</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                    <a href="{{ route('admin.reviews.index') }}" class="nav-link">Reviews</a>
                </div>

                <div style="display: flex; align-items: center; gap: 10px;">
                    <button class="cart-btn" onclick="window.location.href='{{ route('user.index') }}'">
                        🌐 Live Store
                    </button>
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
                <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.2rem; font-weight: 700; color: #0f172a;">Category Sections Manager</h1>
                <p style="color: #64748b; font-size: 0.95rem; margin-top: 4px;">Edit storefront category block titles (e.g. Audio Gear, Gaming PC, Furniture) shown below the hero section.</p>
            </div>
            <button class="cart-btn" onclick="openAddCategoryModal()" style="padding: 12px 20px; font-size: 0.9rem;">
                + Add New Category Section
            </button>
        </div>

        <!-- CATEGORIES TABLE -->
        <div class="bento-table-card reveal">
            <div class="table-responsive">
                <table class="aura-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Icon / Emoji</th>
                            <th>Category Name</th>
                            <th>Storefront Section Header Title</th>
                            <th>Products Count</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                            <tr data-id="{{ $cat->id }}"
                                data-name="{{ $cat->name }}"
                                data-title="{{ $cat->title }}"
                                data-icon="{{ $cat->icon_emoji }}"
                                data-sort="{{ $cat->sort_order }}"
                                data-status="{{ $cat->status ? 1 : 0 }}">
                                <td><strong>#{{ $cat->id }}</strong></td>
                                <td><span style="font-size: 1.5rem;">{{ $cat->icon_emoji ?? '📦' }}</span></td>
                                <td><strong style="color: #0f172a;">{{ $cat->name }}</strong></td>
                                <td><span style="font-size: 0.95rem; font-weight: 700; color: #2563eb;">{{ $cat->title }}</span></td>
                                <td>
                                    <span style="background: #eff6ff; color: #2563eb; padding: 6px 12px; border-radius: 20px; font-weight: 800; font-size: 0.85rem;">
                                        📦 {{ $cat->products_count ?? 0 }} Items
                                    </span>
                                </td>
                                <td><span style="background: #f1f5f9; padding: 4px 10px; border-radius: 12px; font-weight: 800;">{{ $cat->sort_order }}</span></td>
                                <td>
                                    @if($cat->status)
                                        <span style="background: #dcfce7; color: #15803d; font-size: 0.75rem; font-weight: 800; padding: 4px 10px; border-radius: 20px;">Active</span>
                                    @else
                                        <span style="background: #fef2f2; color: #ef4444; font-size: 0.75rem; font-weight: 800; padding: 4px 10px; border-radius: 20px;">Disabled</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                        <button class="action-circle-btn" style="background: #eff6ff; color: #2563eb; border-color: #bfdbfe;" onclick="openMoveModal({{ $cat->id }}, '{{ addslashes($cat->name) }}')">🔄 Change / Move Products</button>
                                        <button class="action-circle-btn" onclick="editCategory(this)">✏️ Edit Title</button>
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category section?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-circle-btn delete">🗑️ Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: #94a3b8; padding: 32px;">No category sections found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ADD / EDIT MODAL -->
    <div class="modal-overlay" id="categoryModal">
        <div class="modal-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 id="categoryModalTitle" style="font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700;">Edit Category Section</h3>
                <button onclick="closeCategoryModal()" style="background: none; border: none; font-size: 1.4rem; cursor: pointer; color: #64748b;">✕</button>
            </div>

            <form id="categoryForm" method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div id="methodField"></div>

                <div class="form-group">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" id="cName" class="form-input" placeholder="e.g. Audio Gear / Gaming PC / Furniture" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Storefront Section Header Title</label>
                    <input type="text" name="title" id="cTitle" class="form-input" placeholder="e.g. 🎧 Audio Gear & Sound" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group">
                        <label class="form-label">Icon / Emoji</label>
                        <input type="text" name="icon_emoji" id="cIcon" class="form-input" placeholder="e.g. 🎧, 🎮, 🛋️, 📱">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Display Sort Order</label>
                        <input type="number" name="sort_order" id="cSort" class="form-input" value="1">
                    </div>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                    <input type="checkbox" name="status" id="cStatus" value="1" checked style="width: 18px; height: 18px; accent-color: #2563eb;">
                    <label for="cStatus" style="font-weight: 700; color: #0f172a; cursor: pointer;">Enable & Show Section on Storefront</label>
                </div>

                <button type="submit" class="cart-btn" style="width: 100%; padding: 14px; justify-content: center; margin-top: 14px; font-size: 0.95rem;">
                    💾 Save Category Section
                </button>
            </form>
        </div>
    </div>

    <!-- MOVE PRODUCTS MODAL -->
    <div class="modal-overlay" id="moveProductsModal">
        <div class="modal-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700; color: #0f172a;">Move Products To Category</h3>
                    <p style="font-size: 0.82rem; color: #64748b; margin-top: 2px;">Select products and pick a destination category to re-assign them immediately.</p>
                </div>
                <button onclick="closeMoveModal()" style="background: none; border: none; font-size: 1.4rem; cursor: pointer; color: #64748b;">✕</button>
            </div>

            <form action="{{ route('admin.categories.move-products') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Select Destination Category</label>
                    <select name="target_category_id" id="targetCatSelect" class="form-input" required>
                        @foreach($categories as $catItem)
                            <option value="{{ $catItem->id }}">{{ $catItem->icon_emoji ?? '📦' }} {{ $catItem->name }} (#{{ $catItem->id }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Select Products to Move</label>
                    <div style="max-height: 240px; overflow-y: auto; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 12px; background: #f8fafc; display: flex; flex-direction: column; gap: 8px;" id="productsChecklist">
                        @forelse($allProducts as $p)
                            @php
                                $cName = $categories->firstWhere('id', $p->category_id)->name ?? 'General';
                            @endphp
                            <label style="display: flex; align-items: center; gap: 10px; font-size: 0.88rem; font-weight: 600; color: #0f172a; cursor: pointer; padding: 4px 6px; border-radius: 6px; background: #ffffff; border: 1px solid #e2e8f0;" data-catid="{{ $p->category_id }}">
                                <input type="checkbox" name="product_ids[]" value="{{ $p->id }}" class="prod-checkbox" style="width: 18px; height: 18px; accent-color: #2563eb;">
                                <div style="flex: 1; display: flex; justify-content: space-between; align-items: center;">
                                    <span>#{{ $p->id }} — {{ $p->name }}</span>
                                    <span style="font-size: 0.75rem; color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 10px;">Currently: {{ $cName }}</span>
                                </div>
                            </label>
                        @empty
                            <div style="color: #94a3b8; font-size: 0.85rem; padding: 10px; text-align: center;">No products available.</div>
                        @endforelse
                    </div>
                </div>

                <button type="submit" class="cart-btn" style="width: 100%; padding: 14px; justify-content: center; margin-top: 14px; font-size: 0.95rem;">
                    🔄 Move Selected Products
                </button>
            </form>
        </div>
    </div>

    <script>
        function openAddCategoryModal() {
            document.getElementById('categoryModalTitle').innerText = "Add New Category Section";
            document.getElementById('categoryForm').action = "{{ route('admin.categories.store') }}";
            document.getElementById('methodField').innerHTML = "";
            document.getElementById('categoryForm').reset();
            document.getElementById('cStatus').checked = true;
            document.getElementById('categoryModal').classList.add('active');
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.remove('active');
        }

        function editCategory(btn) {
            const tr = btn.closest('tr');
            const id = tr.dataset.id;

            document.getElementById('categoryModalTitle').innerText = "Edit Category Section #" + id;
            document.getElementById('categoryForm').action = "{{ url('/admin/categories') }}/" + id;
            document.getElementById('methodField').innerHTML = '@method("PUT")';

            document.getElementById('cName').value = tr.dataset.name || '';
            document.getElementById('cTitle').value = tr.dataset.title || '';
            document.getElementById('cIcon').value = tr.dataset.icon || '📦';
            document.getElementById('cSort').value = tr.dataset.sort || '1';
            document.getElementById('cStatus').checked = tr.dataset.status === '1';

            document.getElementById('categoryModal').classList.add('active');
        }

        function openMoveModal(catId, catName) {
            document.getElementById('targetCatSelect').value = catId;
            const checkboxes = document.querySelectorAll('.prod-checkbox');
            checkboxes.forEach(cb => {
                const parentLabel = cb.closest('label');
                if (parentLabel && parentLabel.dataset.catid == catId) {
                    cb.checked = true;
                } else {
                    cb.checked = false;
                }
            });
            document.getElementById('moveProductsModal').classList.add('active');
        }

        function closeMoveModal() {
            document.getElementById('moveProductsModal').classList.remove('active');
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
