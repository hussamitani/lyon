<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryResponseRequest;
use App\Http\Requests\UpdateInquiryResponseRequest;
use App\Models\InquiryResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class InquiryResponseController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function store(StoreInquiryResponseRequest $request): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function show(InquiryResponse $inquiryResponse): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function edit(InquiryResponse $inquiryResponse): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome');
    }

    public function update(UpdateInquiryResponseRequest $request, InquiryResponse $inquiryResponse): RedirectResponse
    {
        return redirect()->route('welcome');
    }

    public function destroy(InquiryResponse $inquiryResponse): RedirectResponse
    {
        return redirect()->route('welcome');
    }
}
