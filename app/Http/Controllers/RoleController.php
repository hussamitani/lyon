<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function show(Role $role): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function edit(Role $role): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function destroy(Role $role): RedirectResponse
    {
        return redirect()->route('welcome');
    }
}
