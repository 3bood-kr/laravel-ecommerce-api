<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return Response::success(RoleResource::collection($roles));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($request->except('permissions'));
        if(!$role){
            Response::errorInternal();
        }
        if($request->has('permissions')){
            $permissions = Permission::pluck('name')->toArray();
            $tmp = array_intersect($permissions, $request->input('permissions', []));
            foreach ($tmp as $item){
                $role->givePermissionTo($item);
            }
        }
        return Response::success();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //findById is overriden in app/Models/Role.php to throw 404 http response
        $role = Role::findById($id, 'web');
        return Response::success(new RoleResource($role));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $data = $request->validated();
        $role = Role::findById($id, 'web');
        if(!$role->update($request->except('permissions'))){
            Response::errorInternal();
        }
        if($request->has('permissions')){
            $permissions = Permission::pluck('name')->toArray();
            $tmp = array_intersect($permissions, $request->input('permissions', []));
            $role->syncPermissions($tmp);
        }
        return Response::success(new RoleResource($role));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findById($id, 'web');
        if(!$role->delete()){
            Response::errorInternal();
        }
        return Response::success();
    }
}
