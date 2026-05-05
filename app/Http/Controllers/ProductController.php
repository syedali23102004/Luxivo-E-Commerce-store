<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products with filters and pagination.
     */
    public function index(Request $request)
    {
        // Get all categories for sidebar filter
        $categories = Category::all();

        // Start building the query
        $query = Product::with('category');

        // Apply category filter
        if ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Apply price filters
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('brand', 'like', '%' . $search . '%');
            });
        }

        // Apply sorting
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
                $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Paginate results (12 per page)
        $products = $query->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified product.
     */
    public function show($slug)
    {
        // Find product by slug or return 404
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        // Get related products (same category, limit 4, exclude current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Display products by category.
     */
    public function byCategory($slug)
    {
        // Find category by slug or return 404
        $category = Category::where('slug', $slug)->firstOrFail();

        // Get all categories for sidebar
        $categories = Category::all();

        // Get products of that category (paginated 12)
        $products = Product::where('category_id', $category->id)
            ->with('category')
            ->paginate(12);

        return view('products.index', compact('products', 'categories', 'category'));
    }
}