<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Jiannei\Response\Laravel\Support\Facades\Response;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('can:categories-read')->only(['index', 'show']);
        $this->middleware('can:categories-create')->only('store');
        $this->middleware('can:categories-update')->only('update');
        $this->middleware('can:categories-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return Response::success(CategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        if(!$category){
            Response::errorInternal();
        }
        return Response::success();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            Response::errorNotFound();
        }
        return Response::success(new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        if(!$category){
            Response::errorNotFound();
        }
        $data = $request->validated();
        if(!$category->update($data)){
            Response::errorInternal();
        };
        return Response::success();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            Response::errorNotFound();
        }
        if(!$category->delete()){
            Response::errorInternal();
        }
        return Response::success();
    }
}
