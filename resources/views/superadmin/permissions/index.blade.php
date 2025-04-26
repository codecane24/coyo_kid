@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h1 class="h3 mb-1">Permissions Management</h1>
                    <div class="text-muted d-flex align-items-center">
                        <a href="{{ route('superadmin.dashboard') }}" class="text-muted">Dashboard</a>
                        <i class="fas fa-chevron-right mx-2 small"></i>
                        <span>Permissions</span>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-primary px-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plus me-2"></i> Add Permission
                            <i class="fas fa-chevron-down ms-2 small"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                                    <i class="fas fa-plus-circle me-2"></i> Create New
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="row mb-4">
                <div class="col-lg-4">
                    <div class="search-box">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Search permissions...">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 text-end">
                    <div class="d-inline-block">
                        <select class="form-select" id="rowsPerPage">
                            <option value="10">10 Entries</option>
                            <option value="25">25 Entries</option>
                            <option value="50">50 Entries</option>
                            <option value="100">100 Entries</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="permissionsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4">#</th>
                                    <th class="border-0">Permission Name</th>
                                    <th class="border-0">Guard Name</th>
                                    <th class="border-0">Created At</th>
                                    <th class="border-0 text-end px-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permissions as $permission)
                                <tr>
                                    <td class="px-4">{{ $loop->iteration }}</td>
                                    <td class="fw-medium">{{ $permission->name }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $permission->guard_name }}</span>
                                    </td>
                                    <td>{{ $permission->created_at->format('M d, Y') }}</td>
                                    <td class="text-end px-4">
                                        <a href="{{ route('superadmin.permissions.edit', $permission->id) }}"
                                           class="btn btn-sm btn-link text-dark px-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('superadmin.permissions.destroy', $permission->id) }}"
                                              method="POST"
                                              class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-link text-danger px-2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-lock fa-2x mb-3"></i>
                                            <p class="mb-0">No permissions found</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Permission Modal -->
    <div class="modal fade" id="addPermissionModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Add New Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addPermissionForm" action="{{ route('superadmin.permissions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Permission Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guard Name</label>
                            <select class="form-select" name="guard_name">
                                <option value="web">Web</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addPermissionForm" class="btn btn-primary px-4">Add Permission</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#permissionsTable').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 10,
        responsive: true,
        order: [[0, 'asc']],
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            search: "",
            searchPlaceholder: "Search permissions...",
            lengthMenu: "_MENU_ entries per page",
        },
        columnDefs: [
            {
                targets: -1,
                orderable: false,
                searchable: false
            }
        ]
    });

    // Delete confirmation
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Delete Permission?',
            text: "This action cannot be undone",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Success message auto-hide
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.remove();
        }, 3000);
    }
});
</script>
@endsection
