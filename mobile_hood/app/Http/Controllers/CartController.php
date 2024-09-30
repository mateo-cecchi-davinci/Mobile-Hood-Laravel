<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Buisness;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\DeleteFromCartRequest;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addProducts(CartRequest $request)
    {
        $data = $request->validated();

        $cart = new Cart();

        $user = intval($data['user']);
        $buisness = intval($data['buisness']);
        $product = intval($data['product']);

        $cart->fk_carts_users = $user;
        $cart->fk_carts_products = $product;
        $cart->quantity = $data['quantity'];

        $cart->save();

        $productsByCategory = $data['productsByCategory'];

        $cartProducts = $this->getCartProducts($user, $buisness);
        $buisness = $this->getBuisness(intval($data['buisness']))->toArray();

        $products = view('components.products', compact('buisness', 'productsByCategory', 'cartProducts'))->render();
        $cart = view('components.cart.cart', compact('buisness', 'cartProducts'))->render();

        return response()->json([
            'products' => $products,
            'cart' => $cart
        ]);
    }

    public function delete(DeleteFromCartRequest $request)
    {
        $data = $request->validated();

        foreach ($data['products'] as $product) {
            foreach ($data['cartProducts'] as $key => $cart) {
                if ($cart['fk_carts_users'] == $data['user'] && $cart['fk_carts_products'] == $product) {
                    $carts = $this->getCart($cart['fk_carts_users'], $cart['fk_carts_products']);

                    Log::info($carts);
                    foreach ($carts as $cartModel) {
                        $cartModel->delete();
                    }

                    unset($data['cartProducts'][$key]);
                }
            }

            $data['cartProducts'] = array_values($data['cartProducts']);
        }

        $cartProducts = $data['cartProducts'];
        $buisness = $this->getBuisness(intval($data['buisness']));

        $cart = view('components.cart.cart', compact('cartProducts', 'buisness'))->render();

        return response()->json([
            'success' => 'Productos eliminados con éxito',
            'cart' => $cart
        ]);
    }

    private function getCart($user, $product)
    {
        return Cart::where(['fk_carts_users' => $user, 'fk_carts_products' => $product])->with(['product'])->get();
    }

    private function getBuisness($buisness)
    {
        return Buisness::where(['is_active' => true, 'id' => $buisness])->first();
    }

    private function getCartProducts($user, $buisness)
    {
        return Cart::select('fk_carts_users', 'fk_carts_products', DB::raw('SUM(quantity) as quantity'))
            ->join('products', 'carts.fk_carts_products', '=', 'products.id')
            ->join('categories', 'products.fk_products_categories', '=', 'categories.id')
            ->where('fk_carts_users', $user)
            ->where('categories.fk_categories_buisnesses', $buisness)
            ->groupBy('fk_carts_users', 'fk_carts_products')
            ->with(['product'])
            ->get()->toArray();
    }
}
