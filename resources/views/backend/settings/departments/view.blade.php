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

          <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
              <a href="{{url('department/'.$department->department_id.'/edit')}}" class="btn btn-primary">
                <i class="far fa-edit mr-2"></i> Edit Department
              </a>
              <button type="button" class="btn btn-danger ml-2" onclick="confirmDelete({{ $department->department_id }}, '{{ $department->department_name }}', '{{ $department->department_code }}')">
                <i class="fas fa-trash-alt mr-2"></i> Delete Department
              </button>
            </div>
            <a href="{{url('/department')}}" class="btn btn-secondary">
              <i class="fas fa-list mr-2"></i> View All
            </a>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white border-0">
          <h5 class="modal-title" id="deleteConfirmModalLabel">
            <i class="fas fa-exclamation-circle mr-2"></i> Confirm Delete
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-4">
          <p class="text-dark font-weight-bold mb-3">
            Are you sure you want to permanently delete this department?
          </p>
          <div class="alert alert-warning border-left-warning" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <strong>Warning:</strong> This action cannot be undone.
          </div>
          <div class="card border-left-danger">
            <div class="card-body">
              <p class="mb-2">
                <strong>Code:</strong>
                <span class="badge badge-light border border-danger text-danger" id="deleteCode"></span>
              </p>
              <p class="mb-2">
                <strong>Name:</strong>
                <span class="text-dark" id="deleteName"></span>
              </p>
              <p class="mb-0">
                <strong>Status:</strong>
                <span id="deleteStatus"></span>
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i> Cancel
          </button>
          <form id="deleteForm" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-trash-alt mr-2"></i> Delete Permanently
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function confirmDelete(departmentId, departmentName, departmentCode) {
      // Populate modal with department details
      document.getElementById('deleteCode').textContent = departmentCode;
      document.getElementById('deleteName').textContent = departmentName;

      // Set form action
      document.getElementById('deleteForm').action = '/department/' + departmentId;

      // Show modal
      $('#deleteConfirmModal').modal('show');
    }
  </script>

@endsection
