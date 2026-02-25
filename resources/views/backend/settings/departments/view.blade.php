@extends('backend.layouts.master')
@section('title','View-Department')
@section('dpt_menu-open','menu-open')
@section('dpt_active','active')
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Department Details</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{url('/department')}}" class="btn btn-outline-primary">
              <i class="fas fa-arrow-left"></i> Back
            </a>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-building mr-2"></i>Information
            </h3>
          </div>

          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <div class="form-group mb-0">
                  <label class="text-muted mb-1">Department Code</label>
                  <div class="d-flex align-items-center">
                    <span class="badge badge-light border border-primary text-primary p-2">{{$department->department_code}}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-0">
                  <label class="text-muted mb-1">Department Name</label>
                  <p class="mb-0 font-weight-bold">{{$department->department_name}}</p>
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-12">
                <label class="text-muted mb-1">Description</label>
                <div class="border rounded p-3 bg-light">
                  <p class="mb-0">{{$department->description ?: '—'}}</p>
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="text-muted mb-1">Status</label>
                @if($department->department_status === 'active')
                  <span class="badge badge-success p-2"><i class="fas fa-check-circle mr-1"></i> Active</span>
                @else
                  <span class="badge badge-secondary p-2"><i class="fas fa-times-circle mr-1"></i> Inactive</span>
                @endif
              </div>
              <div class="col-md-6">
                <label class="text-muted mb-1">Created</label>
                <p class="mb-0">{{ optional($department->created_at)->format('M d, Y H:i') }}</p>
              </div>
            </div>
          </div>

          <div class="card-footer d-flex justify-content-between">
            <div>
              <a href="{{url('department/'.$department->department_id.'/edit')}}" class="btn btn-outline-primary">
                <i class="far fa-edit"></i> Edit
              </a>
              <button type="button" class="btn btn-outline-danger ml-2 delete-department-btn" data-id="{{ $department->department_id }}" data-name="{{ $department->department_name }}" data-code="{{ $department->department_code }}">
                <i class="fas fa-trash-alt"></i> Delete
              </button>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

  </div>

  <!-- Hidden form for delete operations -->
  <form id="delete-form" method="POST" style="display: none;">
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

    $(document).on('click', '.delete-department-btn', function() {
        const departmentId = $(this).data('id');
        const departmentName = $(this).data('name');
        const departmentCode = $(this).data('code');

        Swal.fire({
            title: '<strong>Delete Department?</strong>',
            html: `<p>Are you sure you want to delete the department: <strong>${departmentName}</strong> (${departmentCode})?</p>
                  <p><strong>Note:</strong> This action cannot be undone and all related records will be permanently removed.</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash"></i> Yes, delete department',
            cancelButtonText: '<i class="fas fa-times"></i> Cancel',
            reverseButtons: true,
            customClass: {
                popup: 'border-radius-lg',
                title: 'text-capitalize'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = $('#delete-form');
                form.attr('action', '{{ url("department") }}/' + departmentId);
                form.submit();
            }
        });
    });
});
</script>
@endpush
