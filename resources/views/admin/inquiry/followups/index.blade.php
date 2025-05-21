@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <h2 class="mb-4">Follow Ups for Inquiry #{{ $inquiry->id }}</h2>

            <div class="card mb-5 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Follow-Up</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.followups.store', $inquiry) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="follow_up_date" class="form-label">Follow-Up Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="follow_up_date" name="follow_up_date"
                                class="form-control @error('follow_up_date') is-invalid @enderror" required>
                            @error('follow_up_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea id="notes" name="notes" rows="4" class="form-control @error('notes') is-invalid @enderror"
                                placeholder="Optional additional information..."></textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="pending" selected>Pending</option>
                                <option value="done">Done</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Add Follow-Up</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Existing Follow-Ups</h5>
                </div>
                <div class="card-body">
                    @if ($followUps->isEmpty())
                        <p class="text-muted">No follow-ups found for this inquiry.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($followUps as $followUp)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ \Carbon\Carbon::parse($followUp->follow_up_date)->format('M d, Y') }}</strong>
                                        —
                                        <span
                                            class="badge bg-{{ $followUp->status == 'pending' ? 'warning' : ($followUp->status == 'done' ? 'success' : 'danger') }}">
                                            {{ ucfirst($followUp->status) }}
                                        </span>
                                        <br>
                                        <small class="text-muted">{{ $followUp->notes ?? 'No notes added.' }}</small>
                                    </div>
                                    <small class="text-muted">{{ $followUp->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
