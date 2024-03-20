<?php

namespace App\Http\Controllers\api\admin;

use App\Enums\ResponseCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Jiannei\Enum\Laravel\Repositories\Enums\HttpStatusCodeEnum;
use Jiannei\Response\Laravel\Support\Facades\Response;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('can:products-read')->only(['index', 'show']);
        $this->middleware('can:products-create')->only('store');
        $this->middleware('can:products-update')->only('update');
        $this->middleware('can:products-delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return Response::success(ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);
        if(!$product){
            Response::errorInternal();
        }
        return Response::success();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            Response::errorNotFound();
        }
        return Response::success(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();
        $product = Product::find($id);
        if(!$product){
            Response::errorNotFound();
        }
        if(!$product->update($data)){
            Response::errorInternal();
        }
        return Response::success();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            Response::errorNotFound();
        }
        if(!$product->delete()){
            Response::errorInternal();
        }
        return Response::success();
    }
}
