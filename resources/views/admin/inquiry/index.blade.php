@extends('layout.mainlayout')

@push('styles')
    <style>
        .card {
            border-radius: 1rem;
            box-shadow: 0 2px 16px 0 rgba(60, 72, 88, .10);
            border: none;
        }

        .card-header {
            border-radius: 1rem 1rem 0 0;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .table {
            border-radius: 0.75rem;
            overflow: hidden;
            background: #fff;
        }

        .table thead th {
            background: #f1f3f7;
            color: #495057;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
        }

        .table tbody tr {
            transition: background 0.2s;
        }

        .table tbody tr:hover {
            background: #f6f8fa;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9fafb;
        }

        .badge {
            font-size: 0.95em;
            padding: 0.45em 1em;
            border-radius: 999px;
            background: #e7f1ff;
            color: #2563eb;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .dropdown-menu {
            min-width: 8rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(60, 72, 88, .10);
        }

        .btn-light.btn-sm.dropdown-toggle {
            border-radius: 50%;
            width: 2.2rem;
            height: 2.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0.5em;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 6px 12px;
            background: #f8f9fa;
        }

        .dataTables_length select {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 4px 8px;
            background: #f8f9fa;
        }

        .table th,
        .table td {
            vertical-align: middle !important;
            padding: 0.85rem 1.2rem !important;
        }

        .table-responsive {
            overflow-x: unset;
        }
    </style>
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h1 class="h3 mb-1">Inquiry Management</h1>
                    <div class="text-muted d-flex align-items-center">
                        <a href="{{ route('superadmin.dashboard') }}" class="text-muted">Dashboard</a>
                        <i class="fas fa-chevron-right mx-2 small"></i>
                        <span>Inquires</span>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">All Inquiries</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover mb-0" id="usersTable">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Name</th>
                                <th width="25%">Admission Type</th>
                                <th width="15%">Branch</th>
                                <th width="20%">Created At</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if ($errors->any())
            toastr.error("{{ $errors->first() }}");
        @endif

        $(document).ready(function() {
            // Server-side DataTable
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.inquiries.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'admission_type',
                        name: 'admission_type'
                    },
                    {
                        data: 'city',
                        name: 'city',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            return moment(data).format('MMM DD, YYYY');
                        }
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                responsive: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search users...",
                    lengthMenu: "_MENU_ Inquiries per page",
                    emptyTable: "No Inquiries found",
                    zeroRecords: "No matching Inquiries found"
                },
                drawCallback: function() {
                    // Re-initialize tooltips after table redraw
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });

            // Handle edit user click
            $(document).on('click', '.edit-user', function(e) {
                e.preventDefault();
                const userId = $(this).data('id');
                const userName = $(this).data('name');
                const userEmail = $(this).data('email');
                const userRole = $(this).data('role');

                $('#edit_name').val(userName);
                $('#edit_email').val(userEmail);
                $('#edit_role').val(userRole);

                $('#editUserForm').attr('action', `/superadmin/users/${userId}`);
                $('#editUserModal').modal('show');
            });

            // Handle delete user confirmation
            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
                var form = this;

                Swal.fire({
                    title: 'Delete User?',
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
    </script>
@endsection
