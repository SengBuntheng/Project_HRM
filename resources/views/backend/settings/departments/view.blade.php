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
              <form action="{{ url('/department/'.$department->department_id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this department? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger ml-2">
                  <i class="fas fa-trash-alt"></i> Delete
                </button>
              </form>
            </div>
            <a href="{{url('/department')}}" class="btn btn-secondary">
              <i class="fas fa-list"></i> View All
            </a>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

  </div>

@endsection
