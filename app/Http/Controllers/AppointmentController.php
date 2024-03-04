<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function show(Appointment $appointment): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function edit(Appointment $appointment): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        return redirect()->route('welcome');
    }
}
