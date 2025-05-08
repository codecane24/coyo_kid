@extends('layout.mainlayout')

@section('title', 'Inquiry Details')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Inquiry Details</h5>
                </div>
                <div class="card-body">
                    <h6 class="text-uppercase text-secondary mb-3">Student Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>First Name:</strong> {{ $inquiry->first_name }}</div>
                        <div class="col-md-4"><strong>Middle Name:</strong> {{ $inquiry->middle_name ?? '-' }}</div>
                        <div class="col-md-4"><strong>Surname:</strong> {{ $inquiry->surname }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($inquiry->date_of_birth)->format('d M Y') }}</div>
                        <div class="col-md-4"><strong>Gender:</strong> {{ ucfirst($inquiry->gender) }}</div>
                        <div class="col-md-4"><strong>Admission Type:</strong> {{ $inquiry->admission_type }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4"><strong>Batch:</strong> {{ implode(', ', $inquiry->batch ?? []) }}</div>
                    </div>

                    <h6 class="text-uppercase text-secondary mb-3">Parent Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Father's Name:</strong> {{ $inquiry->father_name }}</div>
                        <div class="col-md-4"><strong>Phone:</strong> {{ $inquiry->father_phone }}</div>
                        <div class="col-md-4"><strong>Occupation:</strong> {{ $inquiry->father_occupation ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Mother's Name:</strong> {{ $inquiry->mother_name }}</div>
                        <div class="col-md-4"><strong>Phone:</strong> {{ $inquiry->mother_phone ?? '-' }}</div>
                        <div class="col-md-4"><strong>Occupation:</strong> {{ $inquiry->mother_occupation ?? '-' }}</div>
                    </div>

                    <h6 class="text-uppercase text-secondary mb-3">Address</h6>
                    <div class="row mb-3">
                        <div class="col-md-6"><strong>Address Line 1:</strong> {{ $inquiry->address_line_1 }}</div>
                        <div class="col-md-6"><strong>Address Line 2:</strong> {{ $inquiry->address_line_2 ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>City:</strong> {{ $inquiry->city }}</div>
                        <div class="col-md-4"><strong>State:</strong> {{ $inquiry->state }}</div>
                        <div class="col-md-4"><strong>Pin Code:</strong> {{ $inquiry->pin_code }}</div>
                    </div>

                    <h6 class="text-uppercase text-secondary mb-3">Referral Source</h6>
                    <div class="mb-3">
                        {{ implode(', ', $inquiry->referral_source ?? []) }}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">Back to List</a>
                        <a href="{{ route('admin.inquiries.edit', $inquiry->id) }}" class="btn btn-primary ml-2">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
