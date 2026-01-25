@extends('backend.layouts.master')
@section('title','Employees')
@section('e_menu-open','menu-open')
@section('e_active','active')
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Employees</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Employees</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee List</h3>
                <div class="card-tools">
                  <a href="{{ route('employees.create') }}" class="btn btn-primary">Add New Employee</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif
                
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Position</th>
                      <th>Department</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($employees as $employee)
                    <tr>
                      <td>{{ $employee->id }}</td>
                      <td>{{ $employee->first_name }}</td>
                      <td>{{ $employee->last_name }}</td>
                      <td>{{ $employee->email }}</td>
                      <td>{{ $employee->position }}</td>
                      <td>{{ $employee->department }}</td>
                      <td>
                        <span class="badge badge-{{ $employee->status == 'active' ? 'success' : ($employee->status == 'inactive' ? 'warning' : 'danger') }} badge-pill">
                          {{ ucfirst($employee->status) }}
                        </span>
                      </td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Employee Actions">
                          <a href="{{ route('employees.show', $employee->id) }}\" class="btn btn-sm btn-outline-info" title="View">
                            <i class="fas fa-eye"></i>
                          </a>
                          <a href="{{ route('employees.edit', $employee->id) }}\" class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                          <button type="button" class="btn btn-sm btn-outline-danger delete-employee-btn" title="Delete" data-id="{{ $employee->id }}" data-name="{{ $employee->first_name }} {{ $employee->last_name }}" data-email="{{ $employee->email }}">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="8" class="text-center">No employees found</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
                
                <!-- Pagination -->
                {{ $employees->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

<!-- Hidden form for delete operations -->
<form id="delete-employee-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
$(document).ready(function() {
    $('.delete-employee-btn').on('click', function() {
        const employeeId = $(this).data('id');
        const employeeName = $(this).data('name');
        const employeeEmail = $(this).data('email');
        
        Swal.fire({
            title: 'Delete Employee?',
            html: `<p>Are you sure you want to delete the employee: <strong>${employeeName}</strong> (${employeeEmail})?</p>
                  <p><strong>Note:</strong> This action cannot be undone and all related records will be permanently removed.</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete employee',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = $('#delete-employee-form');
                form.attr('action', '/employees/' + employeeId);
                form.submit();
            }
        });
    });
});
</script>