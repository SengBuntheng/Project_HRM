@extends('backend.layouts.master')
@section('title','Edit-Department')
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
                    <h1 class="m-0">Edit Department</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <a href="{{url('/department')}}" type="button" class="btn btn-block bg-gradient-primary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">Edit Department Form</h3>
                        </div>

                        <!-- form start -->
                        <form action="{{url('/department/'.$department->department_id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_code">Department Code</label>
                                            <input type="text" value="{{$department->department_code}}" name="department_code" id="department_code" class="form-control" placeholder="Code">
                                            @error('department_code')
                                                <small class="text-danger">{{($message)}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_name">Department Name</label>
                                            <input type="text" value="{{$department->department_name}}" name="department_name" id="department_name" class="form-control" placeholder="Department name">
                                            @error('department_name')
                                                <small class="text-danger">{{($message)}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="department_description">Description</label>
                                            <textarea class="form-control" name="department_description" id="department_description" rows="4" placeholder="Enter description">{{$department->description}}</textarea>
                                            @error('department_description')
                                                <small class="text-danger">{{($message)}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department_status" value="active" {{$department->department_status == 'active' ? 'checked' : ''}}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department_status" value="inactive" {{$department->department_status == 'inactive' ? 'checked' : ''}}>
                                        <label class="form-check-label">Inactive</label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-save"></i> UPDATE
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        </div><!-- /.container-fluid -->
    </section>

  </div>

@endsection
