<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryTypeRequest;
use App\Http\Requests\UpdateInquiryTypeRequest;
use App\Models\InquiryType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class InquiryTypeController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function store(StoreInquiryTypeRequest $request): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function show(InquiryType $inquiryType): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function edit(InquiryType $inquiryType): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function update(UpdateInquiryTypeRequest $request, InquiryType $inquiryType): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function destroy(InquiryType $inquiryType): RedirectResponse
    {
        return redirect()->route('welcome');
    }
}
