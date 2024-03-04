<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryStatusRequest;
use App\Http\Requests\UpdateInquiryStatusRequest;
use App\Models\InquiryStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class InquiryStatusController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function store(StoreInquiryStatusRequest $request): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function show(InquiryStatus $inquiryStatus): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function edit(InquiryStatus $inquiryStatus): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function update(UpdateInquiryStatusRequest $request, InquiryStatus $inquiryStatus): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function destroy(InquiryStatus $inquiryStatus): RedirectResponse
    {
        return redirect()->route('welcome');
    }
}
