<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentTypeRequest;
use App\Http\Requests\UpdateAppointmentTypeRequest;
use App\Models\AppointmentType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class AppointmentTypeController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function store(StoreAppointmentTypeRequest $request): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function show(AppointmentType $appointmentType): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function edit(AppointmentType $appointmentType): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function update(UpdateAppointmentTypeRequest $request, AppointmentType $appointmentType): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function destroy(AppointmentType $appointmentType): RedirectResponse
    {
        return redirect()->route('welcome');
    }
}
