@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-1">Edit Permission</h1>
                <div class="text-muted d-flex align-items-center">
                    <a href="{{ route('superadmin.dashboard') }}" class="text-muted">Dashboard</a>
                    <i class="fas fa-chevron-right mx-2 small"></i>
                    <a href="{{ route('superadmin.permissions.index') }}" class="text-muted">Permissions</a>
                    <i class="fas fa-chevron-right mx-2 small"></i>
                    <span>Edit</span>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('superadmin.permissions.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('superadmin.permissions.update', $permission->id) }}" class="form-horizontal">
                            @csrf
                            @method('PUT')

                            <div class="row mb-4">
                                <label class="col-md-3 form-label text-md-end">
                                    Permission Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $permission->name) }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Enter a unique permission name (e.g., manage-users, view-reports)
                                    </small>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label text-md-end">
                                    Guard Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select name="guard_name" class="form-select @error('guard_name') is-invalid @enderror">
                                        <option value="web" {{ $permission->guard_name === 'web' ? 'selected' : '' }}>Web</option>
                                        <option value="api" {{ $permission->guard_name === 'api' ? 'selected' : '' }}>API</option>
                                    </select>
                                    @error('guard_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Select the guard this permission belongs to
                                    </small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save me-2"></i>Update Permission
                                    </button>
                                    <a href="{{ route('superadmin.permissions.index') }}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Card -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-info-circle me-2"></i>Permission Details
                        </h5>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Created At:</strong></p>
                                <p class="text-muted">{{ $permission->created_at->format('M d, Y H:i A') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Last Updated:</strong></p>
                                <p class="text-muted">{{ $permission->updated_at->format('M d, Y H:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Auto-hide alerts after 3 seconds
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.remove();
        }, 3000);
    }
});
</script>
@endsection
