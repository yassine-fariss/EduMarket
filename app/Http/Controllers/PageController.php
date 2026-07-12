<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $featured = Product::with('category')
            ->where('status', 'active')
            ->orderBy('title')
            ->take(8)
            ->get();

        $newest = Product::with('category')
            ->where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        return view('home', compact('featured', 'newest', 'categories'));
    }

    public function about(): View
    {
        return view('about');
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function contactSubmit(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        return back()->with('success', 'Your message has been sent successfully. We will respond to you as soon as possible.');
    }
}
