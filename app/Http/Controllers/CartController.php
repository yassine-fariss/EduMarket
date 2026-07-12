<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cart
    ) {}

    public function index(): View
    {
        $items = $this->cart->get();

        return view('cart.index', compact('items'));
    }

    public function add(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($product->status !== 'active') {
            return $this->respond($request, false, 'This product is not available.');
        }

        $result = $this->cart->add($product, (int) $data['quantity']);

        return $this->respond($request, $result['success'], $result['message'], $result);
    }

    public function update(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        $result = $this->cart->updateQuantity((int) $data['product_id'], (int) $data['quantity']);

        return $this->respond($request, $result['success'], $result['message'], $result);
    }

    public function remove(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $result = $this->cart->remove((int) $data['product_id']);

        return $this->respond($request, $result['success'], $result['message'], $result);
    }

    public function clear(Request $request): JsonResponse|RedirectResponse
    {
        $result = $this->cart->clear();

        return $this->respond($request, $result['success'], $result['message'], $result);
    }

    private function respond(Request $request, bool $success, string $message, array $extra = []): JsonResponse|RedirectResponse
    {
        $extra['success'] = $success;
        $extra['message'] = $message;
        $extra['cart_count'] = $extra['count'] ?? $this->cart->count();
        $extra['cart_total'] = $extra['total'] ?? $this->cart->total();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($extra);
        }

        return redirect()->back()->with($success ? 'success' : 'error', $message);
    }
}
