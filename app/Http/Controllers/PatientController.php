<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PatientController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function store(StorePatientRequest $request): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function show(Patient $patient): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function edit(Patient $patient): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function update(UpdatePatientRequest $request, Patient $patient): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        return redirect()->route('welcome');
    }
}
