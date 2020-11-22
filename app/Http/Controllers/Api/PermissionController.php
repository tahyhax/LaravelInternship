<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PermissionApiStoreRequest;
use App\Http\Requests\Dashboard\PermissionApiUpdateRequest;
use App\Http\Resources\Dashboard\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * @var int
     */
    private $perPage = 10;

    /**
     * @param Request $request
     * @return PermissionResource
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page') ?: $this->perPage;
        $permissions = Permission::query()->with('roles')->paginate($perPage);

        return new PermissionResource($permissions);
    }

    /**
     * @param PermissionApiStoreRequest $request
     * @return PermissionResource
     */
    public function store(PermissionApiStoreRequest $request)
    {
        $permission = new Permission($request->all());
        $permission->save();
        $permission->roles()->sync($request->get('roles', []));

        return new PermissionResource($permission->load('roles'));
    }

    /**
     * @param Permission $permission
     * @return PermissionResource
     */
    public function show(Permission $permission)
    {
        return new PermissionResource($permission->load('roles'));
    }

    /**
     * @param PermissionApiUpdateRequest $request
     * @param Permission $permission
     * @return PermissionResource
     */
    public function update(PermissionApiUpdateRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        $permission->roles()->sync($request->get('roles', []));

        return new PermissionResource($permission->load('roles'));
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
