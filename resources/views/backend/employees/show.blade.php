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
                                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Employee
                                </a>
                                <a href="{{ route('employee.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
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

@endsection
