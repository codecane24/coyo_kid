@extends('layout.mainlayout')

@push('styles')
<!-- (reuse your existing styles here) -->
@endpush

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-1">Role Management</h1>
                <div class="text-muted d-flex align-items-center">
                    <a href="{{ route('superadmin.dashboard') }}" class="text-muted">Dashboard</a>
                    <i class="fas fa-chevron-right mx-2 small"></i>
                    <span>Roles</span>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                    <i class="fas fa-plus me-1"></i> Add New Role
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">All Roles</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover mb-0" id="rolesTable">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="70%">Role Name</th>
                            <th width="25%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addRoleForm" action="{{ route('superadmin.roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addRoleForm" class="btn btn-primary px-4">Add Role</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editRoleForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="edit_role_name" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editRoleForm" class="btn btn-primary px-4">Update Role</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#rolesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('superadmin.roles.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'asc']],
            responsive: true,
            language: {
                search: "",
                searchPlaceholder: "Search roles...",
                lengthMenu: "_MENU_ roles per page",
                emptyTable: "No roles found",
                zeroRecords: "No matching roles found"
            }
        });

        // Handle edit role click
        $(document).on('click', '.edit-role', function(e) {
            e.preventDefault();
            const roleId = $(this).data('id');
            const roleName = $(this).data('name');
            $('#edit_role_name').val(roleName);
            $('#editRoleForm').attr('action', `/superadmin/roles/${roleId}`);
            $('#editRoleModal').modal('show');
        });
    });

    toastr.options = {
        "positionClass": "toast-top-right",
        "timeOut": "4000"
    };

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if ($errors->any())
        toastr.error("{{ $errors->first() }}");
    @endif
</script>
@endsection
