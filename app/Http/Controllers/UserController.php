<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductSpecification;
use App\Models\ProductFaq;
use App\Models\HeroCard;
use App\Models\RecentlyViewed;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images')->latest()->get();

        $heroCarouselCards = HeroCard::where('status', 1)->where('section', 'hero_carousel')->orderBy('sort_order')->get();
        $flashSaleCards = HeroCard::where('status', 1)->where('section', 'flash_sale')->orderBy('sort_order')->get();
        $exclusiveReleaseCards = HeroCard::where('status', 1)->where('section', 'exclusive_release')->orderBy('sort_order')->get();
        $focusCard = HeroCard::where('status', 1)->where('section', 'focus_card')->first();

        // Fetch real Recently Viewed products from database
        $sessionId = Session::getId();
        $userId = Auth::guard('user')->id();

        $recentlyViewedQuery = RecentlyViewed::with('product.images')
            ->when($userId, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            }, function($q) use ($sessionId) {
                return $q->where('session_id', $sessionId);
            })
            ->latest('viewed_at');

        $recentlyViewedItems = $recentlyViewedQuery->get()->unique('product_id')->take(3);

        // Fallback to latest products if user has not viewed items yet
        if ($recentlyViewedItems->isEmpty()) {
            $recentlyViewedProducts = $products->take(3);
        } else {
            $recentlyViewedProducts = $recentlyViewedItems->pluck('product')->filter();
        }

        $categories = \App\Models\Category::where('status', 1)->orderBy('sort_order')->get();

        return view('users.index', compact(
            'products',
            'categories',
            'heroCarouselCards',
            'flashSaleCards',
            'exclusiveReleaseCards',
            'focusCard',
            'recentlyViewedProducts'
        ));
    }
    


    public function login()
    {
        return view('users.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        //dd($request->all());
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'confirm_Password' => 'required|string|min:8|same:password',
        ]);

        $validate['password'] = Hash::make($validate['password']);

         unset($validate['confirm_Password']);

        $test = User::create($validate);
        if ($test) {
            return redirect()->back()->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create user.');
        }
    }


    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $data = User::where('email', $request->email)->exists();
        if ($data) {
            // $login_data=[
            //     'email'=>$request->email,
            //     'password'=>$request->password
            // ];

            if (Auth::guard('user')->attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                return redirect()->route('user.index');
            } else {
                // return back()->with(['error' => 'Invalid password.']);
                return back()->withErrors(['password' => 'Invalid password.'])->withInput();

            }
        }



        // if (
        //     Auth::attempt([
        //         'email' => $request->email,
        //         'password' => $request->password
        //     ])
        // ) {
        //     $request->session()->regenerate();

        //     return redirect()->route('user.index');
        // }

        // return back()->with('error', 'Invalid email.');
        return back()->withErrors(['email' => 'Invalid email.'])->withInput();
    }



    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('user.index');
    }

    /**
     * Display the dynamic user product details page.
     */
    public function showProduct($id = null)
    {
        $product = null;
        if ($id) {
            $product = Product::with(['images', 'seller', 'specifications', 'reviews', 'faqs'])
                ->where('id', $id)
                ->orWhere('slug', $id)
                ->first();
        }
        
        if (!$product) {
            $product = Product::with(['images', 'seller', 'specifications', 'reviews', 'faqs'])
                ->latest()
                ->first();
        }

        if ($product) {
            // Track recently viewed product in database
            RecentlyViewed::updateOrCreate(
                [
                    'session_id' => Session::getId(),
                    'user_id' => Auth::guard('user')->id(),
                    'product_id' => $product->id,
                ],
                [
                    'viewed_at' => now(),
                ]
            );
        }

        $similarProducts = Product::with('images')
            ->when($product, function ($query) use ($product) {
                return $query->where('id', '!=', $product->id);
            })
            ->latest()
            ->take(10)
            ->get();

        // Fetch real Recently Viewed products from database
        $sessionId = Session::getId();
        $userId = Auth::guard('user')->id();

        $recentlyViewedQuery = RecentlyViewed::with('product.images')
            ->when($userId, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            }, function($q) use ($sessionId) {
                return $q->where('session_id', $sessionId);
            })
            ->latest('viewed_at');

        $recentlyViewedItems = $recentlyViewedQuery->get()->unique('product_id')->take(3);

        if ($recentlyViewedItems->isEmpty()) {
            $recentlyViewedProducts = Product::with('images')->latest()->take(3)->get();
        } else {
            $recentlyViewedProducts = $recentlyViewedItems->pluck('product')->filter();
        }

        return view('users.product', compact('product', 'similarProducts', 'recentlyViewedProducts'));
    }

    /**
     * Store a dynamic customer review for a product.
     */
    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $product = Product::findOrFail($id);

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => Auth::guard('user')->id(),
            'user_name' => $request->user_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_verified' => true,
        ]);

        return redirect()->back()->with('success', 'Thank you! Your review has been submitted.');
    }

    /**
     * Search products and return the search page view.
     */
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $categories = \App\Models\Category::where('status', 1)->orderBy('sort_order')->get();

        // Always load all products so client-side filter sidebar & live search can search across full catalog
        $products = Product::with(['images', 'reviews', 'category'])->latest()->get();

        return view('users.search', compact('products', 'query', 'categories'));
    }

    /**
     * Get dynamic cart items for current user/session.
     */
    public function getCart()
    {
        $sessionId = Session::getId();
        $userId = Auth::guard('user')->id();

        $cartItems = Cart::when($userId, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            }, function($q) use ($sessionId) {
                return $q->where('session_id', $sessionId);
            })
            ->latest()
            ->get();

        $totalPrice = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return response()->json([
            'status' => 'success',
            'cart' => $cartItems,
            'count' => $cartItems->sum('quantity'),
            'total' => $totalPrice,
            'formatted_total' => '₹' . number_format($totalPrice, 2)
        ]);
    }

    /**
     * Add item to dynamic cart in database.
     */
    public function addToCart(Request $request)
    {
        $sessionId = Session::getId();
        $userId = Auth::guard('user')->id();

        $title = $request->input('title');
        $price = $request->input('price', 0);
        $imagePath = $request->input('imgSrc') ?? $request->input('image_path');
        $productId = $request->input('product_id');

        $query = Cart::when($userId, function($q) use ($userId) {
            return $q->where('user_id', $userId);
        }, function($q) use ($sessionId) {
            return $q->where('session_id', $sessionId);
        });

        if ($productId) {
            $cartItem = (clone $query)->where('product_id', $productId)->first();
        } else {
            $cartItem = (clone $query)->where('title', $title)->first();
        }

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'session_id' => $sessionId,
                'user_id' => $userId,
                'product_id' => $productId,
                'title' => $title ?? 'Store Product',
                'price' => $price,
                'image_path' => $imagePath,
                'quantity' => 1,
            ]);
        }

        return $this->getCart();
    }

    /**
     * Remove item from dynamic cart.
     */
    public function removeFromCart($id)
    {
        $sessionId = Session::getId();
        $userId = Auth::guard('user')->id();

        Cart::when($userId, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            }, function($q) use ($sessionId) {
                return $q->where('session_id', $sessionId);
            })
            ->where('id', $id)
            ->delete();

        return $this->getCart();
    }

    /**
     * Display checkout page with cart contents and user shipping details.
     */
    public function checkout()
    {
        $sessionId = Session::getId();
        $userId = Auth::guard('user')->id();

        $cartItems = Cart::when($userId, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            }, function($q) use ($sessionId) {
                return $q->where('session_id', $sessionId);
            })
            ->latest()
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.index')->with('error', 'Your shopping cart is empty.');
        }

        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        $shippingFee = $subtotal > 999 ? 0 : ($subtotal > 0 ? 99 : 0);
        $total = $subtotal + $shippingFee;

        $user = Auth::guard('user')->user();

        return view('users.checkout', compact('cartItems', 'subtotal', 'shippingFee', 'total', 'user'));
    }

    /**
     * Process checkout form submission and create order.
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,card,upi',
        ]);

        if ($request->payment_method === 'card') {
            $request->validate([
                'card_number' => 'required|string|min:12',
                'card_expiry' => 'required|string',
                'card_cvv' => 'required|string|min:3|max:4',
            ]);
        } elseif ($request->payment_method === 'upi') {
            $request->validate([
                'upi_id' => 'required|string|min:3',
            ]);
        }

        $sessionId = Session::getId();
        $userId = Auth::guard('user')->id();

        $cartItems = Cart::when($userId, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            }, function($q) use ($sessionId) {
                return $q->where('session_id', $sessionId);
            })
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.index')->with('error', 'Your shopping cart is empty.');
        }

        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        // Calculate coupon discount
        $discount = 0;
        $couponCode = $request->input('coupon_code');
        if ($couponCode) {
            $codeUpper = strtoupper(trim($couponCode));
            if ($codeUpper === 'UNCART10') {
                $discount = round($subtotal * 0.10, 2);
            } elseif ($codeUpper === 'WELCOME50') {
                $discount = min(50, $subtotal);
            }
        }

        $shippingFee = ($subtotal - $discount) > 999 ? 0 : 99;
        $total = max(0, $subtotal - $discount + $shippingFee);

        $orderNumber = 'UNC-' . strtoupper(Str::random(8));
        
        // Payment status: 'paid' for card and upi, 'pending' for cod
        $paymentStatus = in_array($request->payment_method, ['card', 'upi']) ? 'paid' : 'pending';

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => $userId,
            'session_id' => $sessionId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->input('country', 'India'),
            'payment_method' => $request->payment_method,
            'payment_status' => $paymentStatus,
            'order_status' => 'processing',
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping_fee' => $shippingFee,
            'total_amount' => $total,
            'coupon_code' => $couponCode,
            'notes' => $request->input('notes'),
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_title' => $cartItem->title,
                'price' => $cartItem->price,
                'quantity' => $cartItem->quantity,
                'image_path' => $cartItem->image_path,
            ]);

            // Decrement stock if product exists
            if ($cartItem->product_id) {
                $product = Product::find($cartItem->product_id);
                if ($product && $product->stock >= $cartItem->quantity) {
                    $product->decrement('stock', $cartItem->quantity);
                }
            }
        }

        // Clear the user's cart
        Cart::when($userId, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            }, function($q) use ($sessionId) {
                return $q->where('session_id', $sessionId);
            })
            ->delete();

        return redirect()->route('user.order.confirmation', $order->order_number)->with('success', 'Order placed successfully!');
    }

    /**
     * Display order confirmation page.
     */
    public function orderConfirmation($order_number)
    {
        $order = Order::with('items')->where('order_number', $order_number)->firstOrFail();
        return view('users.order_confirmation', compact('order'));
    }

    /**
     * Display user order history.
     */
    public function myOrders()
    {
        $userId = Auth::guard('user')->id();
        $sessionId = Session::getId();

        $orders = Order::with('items')
            ->when($userId, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            }, function($q) use ($sessionId) {
                return $q->where('session_id', $sessionId);
            })
            ->latest()
            ->get();

        return view('users.my_orders', compact('orders'));
    }
}