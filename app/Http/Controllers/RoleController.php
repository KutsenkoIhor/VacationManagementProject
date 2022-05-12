<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\EditRoleRequest;
use App\Interfaces\RoleRepositoryInterface;

class RoleController extends Controller
{
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->all();

        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->roleRepository->permissions();

        return view('roles.create', compact([
            'permissions'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRoleRequest $request)
    {
        $this->roleRepository->store($request);

        return redirect(route('roles.index'))->with('status', 'Role added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getRoleById($id);
        $permissions = $this->roleRepository->permissions();

        return view('roles.edit', compact([
            'permissions',
            'role'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, EditRoleRequest $request)
    {
        $this->roleRepository->update($id, $request, );

        return redirect(route('roles.index'))->with('status', 'Role edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleRepository->delete($id);

        return redirect(route('roles.index'))->with('status', 'Role deleted!');
    }
}
