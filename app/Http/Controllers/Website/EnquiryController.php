<?php

namespace App\Http\Controllers\Website;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\StoreEnquiryRequest;
use App\Models\Enquiry;
use App\Support\Website\WebsiteContext;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function create(): View
    {
        return view('website.enquiry', WebsiteContext::shared());
    }

    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        Enquiry::create([
            ...$request->validated(),
            'date' => Carbon::today(),
            'status' => Status::Lead,
            'source' => 'website',
        ]);

        $redirectTo = $request->input('return_to') === 'home'
            ? route('website.home').'#enquiry'
            : route('website.enquiry.create');

        return redirect()
            ->to($redirectTo)
            ->with('enquiry_submitted', true);
    }
}
