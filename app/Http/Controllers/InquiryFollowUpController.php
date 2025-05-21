<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\InquiryFollowUp;

class InquiryFollowUpController extends Controller {
    public function index( Inquiry $inquiry ) {
        return view( 'admin.inquiry.followups.index', [
            'inquiry' => $inquiry,
            'followUps' => $inquiry->followUps()->latest()->get()
        ] );
    }

    public function store( Request $request, Inquiry $inquiry ) {
        $request->validate( [
            'follow_up_date' => 'required|date',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,done,cancelled',
        ] );

        $inquiry->followUps()->create( $request->only( 'follow_up_date', 'notes', 'status' ) );

        return redirect()->back()->with( 'success', 'Follow-up added successfully.' );
    }
}
