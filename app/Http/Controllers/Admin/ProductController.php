<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Get products data for DataTables.
     */
    public function getData()
    {
        $products = Product::with('category')->select('products.*');

        return DataTables::of($products)
            ->addColumn('image', function ($product) {
                return '<img src="' . $product->image . '" alt="' . $product->name . '" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;" onerror="this.src=\'' . asset('images/no-image.svg') . '\'">';
            })
            ->addColumn('category_name', function ($product) {
                return $product->category->name ?? 'N/A';
            })
            ->addColumn('price_formatted', function ($product) {
                return 'Rs. ' . number_format($product->price);
            })
            ->addColumn('discount_price_formatted', function ($product) {
                return $product->discount_price ? 'Rs. ' . number_format($product->discount_price) : '-';
            })
            ->addColumn('is_featured_badge', function ($product) {
                return $product->is_featured ?
                    '<span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span>' :
                    '<span class="badge bg-secondary">Regular</span>';
            })
            ->addColumn('actions', function ($product) {
                return '
                    <a href="' . route('admin.products.edit', $product->id) . '" class="btn btn-sm btn-outline-primary me-1">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteProduct(' . $product->id . ')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                ';
            })
            ->rawColumns(['image', 'is_featured_badge', 'actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'brand' => 'required|string|max:255',
'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url' => 'nullable|url',
            'is_featured' => 'boolean'
        ]);

$imagePath = 'default.jpg';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $imagePath = Storage::url($imagePath);
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'brand' => $request->brand,
            'image' => $imagePath,
            'is_featured' => $request->is_featured ?? false,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'brand' => 'required|string|max:255',
'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url' => 'nullable|url',
            'is_featured' => 'boolean'
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && Storage::disk('public')->exists(str_replace('/storage/', '', $product->image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            }
            // Store new image
            $newImagePath = $request->file('image')->store('products', 'public');
            $imagePath = Storage::url($newImagePath);
        }

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'brand' => $request->brand,
            'image' => $imagePath,
            'is_featured' => $request->is_featured ?? false,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image from storage
        if ($product->image && Storage::disk('public')->exists(str_replace('/storage/', '', $product->image))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product deleted successfully!']);
    }
}