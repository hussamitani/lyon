<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Http\Requests\UpdateInquiryRequest;
use App\Models\Inquiry;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class InquiryController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function store(StoreInquiryRequest $request): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function show(Inquiry $inquiry): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function edit(Inquiry $inquiry): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function update(UpdateInquiryRequest $request, inquiry $inquiry): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        return redirect()->route('welcome');
    }
}
