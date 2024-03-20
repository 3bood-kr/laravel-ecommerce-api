<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('can:reviews-read')->only(['index', 'show']);
        $this->middleware('can:reviews-create')->only('store');
        $this->middleware('can:reviews-update')->only('update');
        $this->middleware('can:reviews-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return Response::success(ReviewResource::collection($reviews));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        $data = $request->validated();
        $data['user_id']=auth()->id();
        $review = Review::create($data);
        if(!$review){
            Response::errorInternal();
        }
        return Response::success();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::find($id);
        if(!$review){
            Response::errorNotFound();
        }
        return Response::success(new ReviewResource($review));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, string $id)
    {
        $data = $request->validated();
        $review = Review::find($id);
        if(!$review){
            Response::errorNotFound();
        }
        if(!$review->update($data)){
            Response::errorInternal();
        }
        return Response::success();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id);
        if(!$review){
            Response::errorNotFound();
        }
        if(!$review->delete()) {
            Response::errorInternal();
        }
        return Response::success();
    }
}
