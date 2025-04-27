@extends('layout.mainlayout')

@push('styles')
<!-- (reuse your existing styles here) -->
@endpush

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-1">Branch Management</h1>
                <div class="text-muted d-flex align-items-center">
                    <a href="{{ route('superadmin.dashboard') }}" class="text-muted">Dashboard</a>
                    <i class="fas fa-chevron-right mx-2 small"></i>
                    <span>Branches</span>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                    <i class="fas fa-plus me-1"></i> Add New Branch
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">All Branches</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover mb-0" id="branchesTable">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">Branch Name</th>
                            <th width="45%">Branch Address</th>
                            <th width="20%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Branch Modal -->
<div class="modal fade" id="addBranchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title">Add New Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addBranchForm" action="{{ route('superadmin.branches.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Branch Name</label>
                        <input type="text" class="form-control" name="branch_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch Address</label>
                        <input type="text" class="form-control" name="branch_address" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addBranchForm" class="btn btn-primary px-4">Add Branch</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Branch Modal -->
<div class="modal fade" id="editBranchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editBranchForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Branch Name</label>
                        <input type="text" class="form-control" id="edit_branch_name" name="branch_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch Address</label>
                        <input type="text" class="form-control" id="edit_branch_address" name="branch_address" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editBranchForm" class="btn btn-primary px-4">Update Branch</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#branchesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('superadmin.branches.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'branch_name', name: 'branch_name' },
                { data: 'branch_address', name: 'branch_address' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'asc']],
            responsive: true,
            language: {
                search: "",
                searchPlaceholder: "Search branches...",
                lengthMenu: "_MENU_ branches per page",
                emptyTable: "No branches found",
                zeroRecords: "No matching branches found"
            }
        });

        // Handle edit branch click
        $(document).on('click', '.edit-branch', function(e) {
            e.preventDefault();
            const branchId = $(this).data('id');
            const branchName = $(this).data('name');
            const branchAddress = $(this).data('address');
            $('#edit_branch_name').val(branchName);
            $('#edit_branch_address').val(branchAddress);
            $('#editBranchForm').attr('action', `/superadmin/branches/${branchId}`);
            $('#editBranchModal').modal('show');
        });

        // Handle delete branch confirmation
        $(document).on('submit', '.delete-form', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Delete Branch?',
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
