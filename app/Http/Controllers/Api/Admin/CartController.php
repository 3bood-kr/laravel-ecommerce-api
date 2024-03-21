<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Jiannei\Response\Laravel\Support\Facades\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::all();
        return Response::success(CartResource::collection($carts));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {
        $data = $request->validated();
        $cart = Cart::create($data);
        if(!$cart){
            Response::errorInternal();
        }
        return Response::success();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = Cart::find($id);
        if(!$cart){
            Response::errorNotFound();
        }
        return Response::success(new CartResource($cart));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartRequest $request, string $id)
    {
        $data = $request->validated();
        $cart = Cart::find($id);
        if(!$cart){
            Response::errorNotFound();
        }
        if(!$cart->update($data)){
            Response::errorInternal();
        }
        return Response::success();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);
        if(!$cart){
            Response::errorNotFound();
        }
        if(!$cart->delete()){
            Response::errorInternal();
        }
        return Response::success();
    }

//    public function getCartItems(string $id){
//        $cart = Cart::find($id);
//        if(!$cart || !$cart->cartItems){
//            Response::errorNotFound();
//        }
//        return Response::success(CartItemResource::collection($cart->cartItems));
//    }
}
