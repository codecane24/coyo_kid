<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Vinkla\Hashids\Facades\Hashids;

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

    public function edit($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        return view('admin.inquiry.edit', compact('inquiry'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Inquiry::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $encodedId = Hashids::encode($row->id);
                    $viewUrl = route('admin.inquiries.show', $encodedId);
                    $deleteUrl = route('admin.inquiries.destroy', $encodedId);

                    // Follow-up URL (using the plain id here, but encode if needed)
                    $followUpUrl = route('admin.followups.index', $row->id);

                    return '
                        <a href="' . $viewUrl . '" class="btn btn-sm btn-info me-1">View</a>
                        <a href="' . $followUpUrl . '" class="btn btn-sm btn-primary me-1" title="Follow Ups">
                            <i class="fas fa-clock"></i> Follow Ups
                        </a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;" class="delete-form">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger delete-btn" onclick="return confirm(\'Delete this inquiry?\')">
                                Delete
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.inquiry.index');
    }


    public function show($id)
    {
        $decodedId = Hashids::decode($id);
        if (empty($decodedId)) {
            return redirect()->back()->with('error', 'Invalid inquiry ID.');
        }

        $inquiry = Inquiry::findOrFail($decodedId[0]);
        return view('admin.inquiry.show', compact('inquiry'));
    }
}
