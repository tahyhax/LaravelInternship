<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleApiStoreRequest;
use App\Http\Requests\Dashboard\RoleApiUpdateRequest;
use App\Http\Resources\Dashboard\RoleResource;
use App\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @var integer
     */
    private $perPage = 10;

    /**
     * @param Request $request
     * @return RoleResource
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page') ?: $this->perPage;
        $roles = Role::query()->with('permissions')->paginate($perPage);

        return new RoleResource($roles);
    }

    /**
     * @param RoleApiStoreRequest $request
     * @return RoleResource
     */
    public function store(RoleApiStoreRequest $request)
    {
        $role = new Role($request->all());
        $role->save();
        $role->permissions()->sync($request->get('permissions'));

        return new RoleResource($role->load('permissions'));
    }

    /**
     * @param Role $role
     * @return RoleResource
     */
    public function show(Role $role)
    {
        return new RoleResource($role->load('permissions'));
    }

    /**
     * @param RoleApiUpdateRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function update(RoleApiUpdateRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->get('permissions'));

        return new RoleResource($role->load('permissions'));
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
