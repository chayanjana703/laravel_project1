<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    /**
     * Display seller dashboard and products scoped strictly to the seller.
     */
    public function index(Request $request)
    {
        // Define list of registered sellers in the system
        $sellersList = [
            1 => ['id' => 1, 'name' => 'TechAura Electronics', 'store_code' => 'STORE-TA-01', 'badge' => 'Verified Audio & Tech'],
            2 => ['id' => 2, 'name' => 'NextGen Gaming Studio', 'store_code' => 'STORE-NG-02', 'badge' => 'Official Gaming Partner'],
            3 => ['id' => 3, 'name' => 'Nordic Living & Furniture', 'store_code' => 'STORE-NL-03', 'badge' => 'Luxury Furniture Specialist'],
        ];

        // Active seller ID (from logged-in user, session, or request parameter, defaulting to seller ID 1)
        $sellerId = (int) ($request->get('seller_id') ?? Auth::id() ?? 1);
        if (!isset($sellersList[$sellerId])) {
            $sellerId = 1;
        }

        $currentSeller = $sellersList[$sellerId];

        // Retrieve ONLY products belonging to this seller
        $products = Product::where('seller_id', $sellerId)
            ->with('images')
            ->latest()
            ->get();

        // Calculate metrics specific ONLY to this seller
        $stats = [
            'total_revenue' => $products->sum('price'),
            'total_products' => $products->count(),
            'active_listings' => $products->where('status', 1)->count(),
            'out_of_stock' => $products->where('stock', 0)->count(),
        ];

        return view('sellers.index', compact('products', 'stats', 'sellersList', 'currentSeller'));
    }
}
