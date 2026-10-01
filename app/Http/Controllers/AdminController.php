<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Admin;
use App\Models\HeroCard;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Admin Command Center Dashboard.
     */
    public function adminindex()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalReviews = ProductReview::count();
        $avgRating = round(ProductReview::avg('rating') ?? 5.0, 1);
        $totalInventoryStock = Product::sum('stock') ?? 0;
        $totalCatalogValue = Product::selectRaw('SUM(price * stock) as total_val')->value('total_val') ?? 0;

        $recentProducts = Product::with(['images', 'category'])->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        $recentReviews = ProductReview::with('product')->latest()->take(5)->get();

        // Dynamic Rating Distribution for Chart
        $ratingsCount = [
            '5_star' => ProductReview::where('rating', 5)->count(),
            '4_star' => ProductReview::where('rating', 4)->count(),
            '3_star' => ProductReview::where('rating', 3)->count(),
            '2_star' => ProductReview::where('rating', 2)->count(),
            '1_star' => ProductReview::where('rating', 1)->count(),
        ];

        // Dynamic Monthly Growth (Products & Users created over last 6 months)
        $months = [];
        $monthlyProducts = [];
        $monthlyUsers = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');
            $monthlyProducts[] = Product::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $monthlyUsers[] = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return view('admin.index', compact(
            'totalProducts',
            'totalUsers',
            'totalReviews',
            'avgRating',
            'totalInventoryStock',
            'totalCatalogValue',
            'recentProducts',
            'recentUsers',
            'recentReviews',
            'ratingsCount',
            'months',
            'monthlyProducts',
            'monthlyUsers'
        ));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function allusers()
    {
        $users = User::latest()->get();
        return view('admin.allusers', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function reviewsIndex()
    {
        $reviews = ProductReview::with('product')->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }

    public function destroyReview(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|min:3|max:1000',
        ], [
            'reason.required' => 'Please provide a reason for deleting this review.',
            'reason.min' => 'The deletion reason must be at least 3 characters long.',
        ]);

        $review = ProductReview::findOrFail($id);
        $review->deletion_reason = $request->input('reason');
        $review->save();
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully. Reason recorded.');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * View all customer orders.
     */
    public function ordersIndex()
    {
        $orders = Order::with('items')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * Update order and payment status.
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|string|in:pending,paid,failed',
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()->back()->with('success', 'Order #' . $order->order_number . ' status updated successfully.');
    }

    /**
     * Storefront Hero Section Cards Manager view.
     */
    public function heroIndex()
    {
        $heroCards = HeroCard::with('product')->orderBy('sort_order')->latest()->get();
        $products = Product::select('id', 'name', 'price')->latest()->get();

        return view('admin.hero', compact('heroCards', 'products'));
    }

    /**
     * Store a new Hero Card.
     */
    public function heroStore(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|string|max:50',
            'product_id' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'image' => 'nullable|string',
        ]);

        $imgPath = $request->image;
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $filename = time() . '_' . uniqid() . '.' . $request->file('image_file')->getClientOriginalExtension();
            $request->file('image_file')->move(public_path('uploads/products'), $filename);
            $imgPath = 'uploads/products/' . $filename;
        }

        HeroCard::create([
            'section' => $request->section,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'badge' => $request->badge,
            'price' => $request->price ?? 0,
            'old_price' => $request->old_price,
            'rating' => $request->rating ?? '4.9',
            'image' => $imgPath,
            'product_id' => $request->product_id,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.hero.index')->with('success', 'Hero Card added successfully!');
    }

    /**
     * Update an existing Hero Card.
     */
    public function heroUpdate(Request $request, $id)
    {
        $card = HeroCard::findOrFail($id);

        $request->validate([
            'section' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|string|max:50',
            'product_id' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'image' => 'nullable|string',
        ]);

        $imgPath = $request->image ?? $card->image;
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $filename = time() . '_' . uniqid() . '.' . $request->file('image_file')->getClientOriginalExtension();
            $request->file('image_file')->move(public_path('uploads/products'), $filename);
            $imgPath = 'uploads/products/' . $filename;
        }

        $card->update([
            'section' => $request->section,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'badge' => $request->badge,
            'price' => $request->price ?? 0,
            'old_price' => $request->old_price,
            'rating' => $request->rating ?? '4.9',
            'image' => $imgPath,
            'product_id' => $request->product_id,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.hero.index')->with('success', 'Hero Card updated successfully!');
    }

    /**
     * Remove a Hero Card.
     */
    public function heroDestroy($id)
    {
        $card = HeroCard::findOrFail($id);
        $card->delete();

        return redirect()->route('admin.hero.index')->with('success', 'Hero Card deleted successfully!');
    }

    /**
     * Category Sections Manager
     */
    public function categoryIndex()
    {
        $categories = \App\Models\Category::withCount('products')->with('products')->orderBy('sort_order')->get();
        $allProducts = Product::select('id', 'name', 'category_id', 'price', 'sku')->orderBy('name')->get();
        return view('admin.categories', compact('categories', 'allProducts'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'icon_emoji' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->name) ?: 'cat-' . time();

        \App\Models\Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'title' => $request->title,
            'icon_emoji' => $request->icon_emoji ?? '📦',
            'sort_order' => $request->sort_order ?? 1,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category Section created successfully!');
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = \App\Models\Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'icon_emoji' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer',
        ]);

        $category->update([
            'name' => $request->name,
            'title' => $request->title,
            'icon_emoji' => $request->icon_emoji ?? '📦',
            'sort_order' => $request->sort_order ?? 1,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category Section updated successfully!');
    }

    public function categoryDestroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category Section deleted successfully!');
    }

    /**
     * Move products to a new category directly from Categories Manager
     */
    public function categoryMoveProducts(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'target_category_id' => 'required|exists:categories,id',
        ]);

        Product::whereIn('id', $request->product_ids)->update([
            'category_id' => $request->target_category_id,
        ]);

        $targetCategory = \App\Models\Category::find($request->target_category_id);

        return redirect()->route('admin.categories.index')->with('success', count($request->product_ids) . ' product(s) moved to "' . ($targetCategory->name ?? 'Category') . '" successfully!');
    }
}
