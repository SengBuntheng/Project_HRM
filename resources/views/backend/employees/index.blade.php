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
            <h1 class="m-0">
              <i class="fas fa-users mr-2" style="color: #007bff;"></i>
              <a href="{{ route('employees.index') }}" style="cursor: pointer; color: inherit; text-decoration: none;">Employees</a>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('employees.index') }}" style="cursor: pointer; color: inherit; text-decoration: none;">Employees</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Alert Section -->
        @if(session('success'))
          <div class="row mb-3">
            <div class="col-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
        @endif

        <!-- Statistics Row -->
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $employees->total() }}</h3>
                <p>Total Employees</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $employees->count() }}</h3>
                <p>Active on This Page</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-check"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>--</h3>
                <p>Pending Reviews</p>
              </div>
              <div class="icon">
                <i class="fas fa-clock"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>--</h3>
                <p>Inactive</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-slash"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Card -->
        <div class="row">
          <div class="col-12">
            <div class="card shadow-sm border-0">
              <div class="card-header bg-white border-bottom">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="card-title mb-0">
                      <i class="fas fa-list mr-2" style="color: #007bff;"></i>
                      Employee List
                    </h3>
                  </div>
                  <div class="col-auto">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
                      <i class="fas fa-plus mr-1"></i> Add New Employee
                    </a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead class="bg-light">
                      <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 8%;">Photo</th>
                        <th style="width: 12%;">First Name</th>
                        <th style="width: 12%;">Last Name</th>
                        <th style="width: 18%;">Email</th>
                        <th style="width: 12%;">Position</th>
                        <th style="width: 12%;">Department</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 15%;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($employees as $employee)
                      <tr class="align-middle">
                        <td>
                          <span class="badge badge-light" style="color: #333; font-size: 11px;">{{ $employee->id }}</span>
                        </td>
                        <td>
                          <img src="{{ $employee->profile_photo_url ?? asset('assets/dist/img/avatar.png') }}" 
                               alt="{{ $employee->first_name }}" 
                               class="rounded-circle border" 
                               style="height: 40px; width: 40px; object-fit: cover;"
                               onerror="this.src='{{ asset('assets/dist/img/avatar.png') }}';"
                               loading="lazy">
                        </td>
                        <td>
                          <strong>{{ $employee->first_name }}</strong>
                        </td>
                        <td>{{ $employee->last_name }}</td>
                        <td>
                          <small class="text-muted">{{ $employee->email }}</small>
                        </td>
                        <td>
                          <span class="badge badge-info">{{ optional($employee->positionRelation)->name ?? $employee->position ?? 'N/A' }}</span>
                        </td>
                        <td>
                          <span class="badge badge-secondary">{{ optional($employee->departmentRelation)->department_name ?? $employee->department ?? 'N/A' }}</span>
                        </td>
                        <td>
                          @if($employee->status == 'active')
                            <span class="badge badge-success">
                              <i class="fas fa-check-circle mr-1"></i>Active
                            </span>
                          @elseif($employee->status == 'inactive')
                            <span class="badge badge-warning">
                              <i class="fas fa-pause-circle mr-1"></i>Inactive
                            </span>
                          @else
                            <span class="badge badge-danger">
                              <i class="fas fa-times-circle mr-1"></i>{{ ucfirst($employee->status) }}
                            </span>
                          @endif
                        </td>
                        <td>
                          <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-outline-info" title="View" data-toggle="tooltip">
                              <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-warning" title="Edit" data-toggle="tooltip">
                              <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-outline-danger delete-employee-btn" title="Delete" 
                                    data-toggle="tooltip" data-id="{{ $employee->id }}" 
                                    data-name="{{ $employee->first_name }} {{ $employee->last_name }}" 
                                    data-email="{{ $employee->email }}">
                              <i class="fas fa-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="9" class="text-center py-5">
                          <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                          <p class="text-muted mt-3">No employees found</p>
                          <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus mr-1"></i> Create First Employee
                          </a>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-white border-top">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                  <small class="text-muted">
                    Showing {{ $employees->firstItem() ?? 0 }} to {{ $employees->lastItem() ?? 0 }} of {{ $employees->total() }} employees
                  </small>
                  <nav aria-label="Page navigation" class="mt-2 mt-md-0">
                    {{ $employees->links('vendor.pagination.custom') }}
                  </nav>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

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
                  <p style="margin-top: 1rem;"><strong>⚠️ Warning:</strong> This action cannot be undone and all related records will be permanently removed.</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash mr-2"></i> Yes, delete employee',
            cancelButtonText: '<i class="fas fa-times mr-2"></i> Cancel',
            reverseButtons: true,
            customClass: {
                popup: 'border-radius-lg',
                title: 'text-capitalize'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = $('#delete-employee-form');
                form.attr('action', '{{ url("employees") }}/' + employeeId);
                form.submit();
            }
        });
    });
});
</script>
@endpush
