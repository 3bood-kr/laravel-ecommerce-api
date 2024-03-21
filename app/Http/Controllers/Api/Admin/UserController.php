<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Jiannei\Response\Laravel\Support\Facades\Response;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('can:users-read')->only(['index', 'show']);
        $this->middleware('can:users-create')->only('store');
        $this->middleware('can:users-update')->only('update');
        $this->middleware('can:users-delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return Response::success(UserResource::collection($users));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        if(!$user){
            Response::errorInternal();
        }
        $user->assignRole($request->role);
        return Response::success();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(!$user){
            Response::errorNotFound();
        }
        return Response::success(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        if(!$user){
            Response::errorNotFound();
        }
        $data = $request->validated();
        if(!$user->update($data)){
            Response::errorInternal();
        }
        return Response::success();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user){
            Response::errorNotFound();
        }
        if(!$user->delete()){
            Response::errorInternal();
        }
        return Response::success();
    }

    public function getUserCarts(User $user){
        return $user;
    }
}
