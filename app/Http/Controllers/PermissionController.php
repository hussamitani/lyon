<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class PermissionController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function show(Permission $permission): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }
}
