<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InquiryController extends Controller
{
    public function create()
    {
        return view('admin.inquiry.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'surname' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'admission_type' => 'required|string|max:255',
            'batch' => 'required|array',
            'batch.*' => 'in:morning,noon',
            'father_name' => 'required|string|max:255',
            'father_phone' => 'required|string|max:20',
            'father_occupation' => 'nullable|string|max:255',
            'mother_name' => 'required|string|max:255',
            'mother_phone' => 'nullable|string|max:20',
            'mother_occupation' => 'nullable|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pin_code' => 'required|string|max:20',
            'referral_source' => 'required|array',
            'referral_source.*' => 'in:newspaper,banners,reference,social_media,tv_ad,other',
        ]);

        Inquiry::create($validated);

        return redirect()->back()->with('success', 'Inquiry created successfully.');
    }
}
