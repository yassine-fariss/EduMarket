<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::with('category')
            ->active()
            ->search($request->search)
            ->byCategorySlug($request->category)
            ->priceBetween(
                $request->filled('min_price') ? (float) $request->min_price : null,
                $request->filled('max_price') ? (float) $request->max_price : null
            )
            ->inStock($request->boolean('in_stock'))
            ->sortBy($request->sort)
            ->paginate(min((int) $request->per_page ?: 12, 48))
            ->withQueryString();

        $categories = Category::has('products')->orderBy('name')->get();

        $activeCategory = $request->category
            ? Category::whereSlug($request->category)->value('name')
            : null;

        return view('shop.index', compact('products', 'categories', 'activeCategory'));
    }

    public function show(Product $product): View
    {
        if ($product->status !== 'active') {
            abort(404);
        }

        $product->load('category');

        $related = Product::with('category')
            ->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
