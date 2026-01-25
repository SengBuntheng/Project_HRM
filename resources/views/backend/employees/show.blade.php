@extends('backend.layouts.master')

@section('title', 'View Employee')
@section('e_menu-open', 'menu-open')
@section('e_active', 'active')
@section('main-content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
                        <li class="breadcrumb-item active">View Employee</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Employee Details</h3>
                            <div class="card-tools">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Employee
                                </a>
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
                                <button type="button" class="btn btn-danger delete-employee-btn" data-id="{{ $employee->id }}" data-name="{{ $employee->first_name }} {{ $employee->last_name }}" data-email="{{ $employee->email }}">
                                    <i class="fas fa-trash"></i> Delete Employee
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">ID:</label>
                                        <p class="mb-0">{{ $employee->id }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Status:</label>
                                        <p class="mb-0">
                                            <span class="badge badge-{{ $employee->status == 'active' ? 'success' : ($employee->status == 'inactive' ? 'warning' : 'danger') }} badge-pill">
                                                {{ ucfirst($employee->status) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">First Name:</label>
                                        <p class="mb-0">{{ $employee->first_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Last Name:</label>
                                        <p class="mb-0">{{ $employee->last_name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Email:</label>
                                        <p class="mb-0">
                                            <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Phone:</label>
                                        <p class="mb-0">
                                            {{ $employee->phone ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Position:</label>
                                        <p class="mb-0">{{ $employee->position }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Department:</label>
                                        <p class="mb-0">{{ $employee->department }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Salary:</label>
                                        <p class="mb-0">${{ number_format($employee->salary, 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Hire Date:</label>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Created At:</label>
                                        <p class="mb-0">{{ $employee->created_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="text-muted">Updated At:</label>
                                        <p class="mb-0">{{ $employee->updated_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Hidden form for delete operations -->
<form id="delete-employee-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Check if jQuery and SweetAlert2 are loaded
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded');
        return;
    }

    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 is not loaded');
        return;
    }

    $(document).on('click', '.delete-employee-btn', function() {
        const employeeId = $(this).data('id');
        const employeeName = $(this).data('name');
        const employeeEmail = $(this).data('email');

        Swal.fire({
            title: '<strong>Delete Employee?</strong>',
            html: `<p>Are you sure you want to delete the employee: <strong>${employeeName}</strong> (${employeeEmail})?</p>
                  <p><strong>Note:</strong> This action cannot be undone and all related records will be permanently removed.</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash"></i> Yes, delete employee',
            cancelButtonText: '<i class="fas fa-times"></i> Cancel',
            reverseButtons: true,
            customClass: {
                popup: 'border-radius-lg',
                title: 'text-capitalize'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = $('#delete-employee-form');
                form.attr('action', '{{ url('employees') }}/' + employeeId);
                form.submit();
            }
        });
    });
});
</script>
@endpush
