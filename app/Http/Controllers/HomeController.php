<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Fetch 15 categories
        $categories = Category::take(15)->get();

        // Fetch 12 featured products with category relationship
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->take(12)
            ->get();

        // Fetch 4 latest products
        $latestProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('home.index', compact('categories', 'featuredProducts', 'latestProducts'));
    }
}
