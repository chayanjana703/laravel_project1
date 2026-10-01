<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use App\Models\ProductFaq;
use App\Models\ProductReview;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products in Admin.
     */
    public function index()
    {
        $products = Product::with(['images', 'specifications', 'faqs', 'reviews', 'seller'])->latest()->get();
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.product.products', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return redirect()->route('admin.products.index');
    }

    /**
     * Store a newly created product in storage with images, specs & FAQs.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'category_id' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'description' => 'nullable|string',
            'image_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'images.*' => 'nullable|string',
            'spec_keys.*' => 'nullable|string',
            'spec_values.*' => 'nullable|string',
            'faq_questions.*' => 'nullable|string',
            'faq_answers.*' => 'nullable|string',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug ?? $request->name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'stock' => $request->stock ?? 10,
            'sku' => $request->sku ?? ('SKU-' . strtoupper(Str::random(6))),
            'category_id' => $request->category_id ?? 1,
            'status' => $request->has('status') ? $request->status : 1,
            'featured' => $request->has('featured') ? 1 : 0,
        ]);

        // Process images
        $collectedImages = [];
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $file) {
                if ($file && $file->isValid()) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products'), $filename);
                    $collectedImages[] = 'uploads/products/' . $filename;
                }
            }
        }

        if ($request->has('images') && is_array($request->images)) {
            foreach ($request->images as $imgText) {
                if (!empty(trim($imgText))) {
                    $collectedImages[] = trim($imgText);
                }
            }
        }

        if (empty($collectedImages)) {
            $collectedImages = [
                'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80'
            ];
        }

        foreach ($collectedImages as $index => $imgPath) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $imgPath,
                'is_primary' => ($index === 0) ? 1 : 0,
            ]);
        }

        // Process specifications
        if ($request->has('spec_keys') && is_array($request->spec_keys)) {
            foreach ($request->spec_keys as $idx => $key) {
                $val = $request->spec_values[$idx] ?? null;
                if (!empty(trim($key)) && !empty(trim($val))) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'spec_key' => trim($key),
                        'spec_value' => trim($val),
                    ]);
                }
            }
        }

        // Process FAQs
        if ($request->has('faq_questions') && is_array($request->faq_questions)) {
            foreach ($request->faq_questions as $idx => $question) {
                $answer = $request->faq_answers[$idx] ?? null;
                if (!empty(trim($question)) && !empty(trim($answer))) {
                    ProductFaq::create([
                        'product_id' => $product->id,
                        'question' => trim($question),
                        'answer' => trim($answer),
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully with images, specifications & FAQs!');
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $id,
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'category_id' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'description' => 'nullable|string',
            'image_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'images.*' => 'nullable|string',
            'spec_keys.*' => 'nullable|string',
            'spec_values.*' => 'nullable|string',
            'faq_questions.*' => 'nullable|string',
            'faq_answers.*' => 'nullable|string',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug ?? $request->name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'stock' => $request->stock ?? 0,
            'sku' => $request->sku ?? $product->sku,
            'category_id' => $request->category_id ?? $product->category_id,
            'status' => $request->status ?? 0,
            'featured' => $request->has('featured') ? 1 : 0,
        ]);

        // Process images update
        $collectedImages = [];
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $file) {
                if ($file && $file->isValid()) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products'), $filename);
                    $collectedImages[] = 'uploads/products/' . $filename;
                }
            }
        }

        if ($request->has('images') && is_array($request->images)) {
            foreach ($request->images as $imgText) {
                if (!empty(trim($imgText))) {
                    $collectedImages[] = trim($imgText);
                }
            }
        }

        if (!empty($collectedImages)) {
            // Delete old physical image files from disk if they are replaced and not used elsewhere
            foreach ($product->images as $oldImg) {
                $oldPath = $oldImg->image;
                if ($oldPath && !in_array($oldPath, $collectedImages) && !Str::startsWith($oldPath, ['http://', 'https://'])) {
                    $isUsedElsewhere = ProductImage::where('image', $oldPath)
                        ->where('product_id', '!=', $product->id)
                        ->exists();

                    if (!$isUsedElsewhere) {
                        $possiblePaths = [
                            public_path($oldPath),
                            public_path('storage/' . $oldPath),
                            storage_path('app/public/' . $oldPath),
                            public_path('uploads/products/' . basename($oldPath)),
                        ];

                        foreach ($possiblePaths as $fullPath) {
                            if (file_exists($fullPath) && is_file($fullPath)) {
                                @unlink($fullPath);
                            }
                        }
                    }
                }
            }

            $product->images()->delete();
            foreach ($collectedImages as $index => $imgPath) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imgPath,
                    'is_primary' => ($index === 0) ? 1 : 0,
                ]);
            }
        }

        // Update specifications
        if ($request->has('spec_keys') && is_array($request->spec_keys)) {
            $product->specifications()->delete();
            foreach ($request->spec_keys as $idx => $key) {
                $val = $request->spec_values[$idx] ?? null;
                if (!empty(trim($key)) && !empty(trim($val))) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'spec_key' => trim($key),
                        'spec_value' => trim($val),
                    ]);
                }
            }
        }

        // Update FAQs
        if ($request->has('faq_questions') && is_array($request->faq_questions)) {
            $product->faqs()->delete();
            foreach ($request->faq_questions as $idx => $question) {
                $answer = $request->faq_answers[$idx] ?? null;
                if (!empty(trim($question)) && !empty(trim($answer))) {
                    ProductFaq::create([
                        'product_id' => $product->id,
                        'question' => trim($question),
                        'answer' => trim($answer),
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage and delete associated image files from disk.
     */
    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        foreach ($product->images as $img) {
            $imgPath = $img->image;
            if ($imgPath && !Str::startsWith($imgPath, ['http://', 'https://'])) {
                // Safely check if any other product in DB is referencing the same image file
                $isUsedByOtherProduct = ProductImage::where('image', $imgPath)
                    ->where('product_id', '!=', $product->id)
                    ->exists();

                if (!$isUsedByOtherProduct) {
                    $possiblePaths = [
                        public_path($imgPath),
                        public_path('storage/' . $imgPath),
                        storage_path('app/public/' . $imgPath),
                        public_path('uploads/products/' . basename($imgPath)),
                    ];

                    foreach ($possiblePaths as $fullPath) {
                        if (file_exists($fullPath) && is_file($fullPath)) {
                            @unlink($fullPath);
                        }
                    }
                }
            }
        }

        $product->images()->delete();
        $product->specifications()->delete();
        $product->reviews()->delete();
        $product->faqs()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product and associated image files deleted successfully!');
    }
}
