@extends('backend.layouts.master')
@section('title','Add-Department')
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
                    <h1 class="m-0">Add-Department</h1>
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
                            <h3 class="card-title">Fill Department Form</h3>
                        </div>

                        <!-- form start -->
                        <form action="{{url('/department')}}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_code">Department Code</label>
                                            <input type="text" value="{{$randomCode}}" name="department_code" id="department_code" class="form-control" placeholder="Code" readonly="readonly">
                                            @error('department_code')
                                                <small class="text-danger">{{($message)}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_name">Department Name</label>
                                            <input type="text" value="{{old('department_name')}}" name="department_name" id="department_name" class="form-control" placeholder="Department name">
                                            @error('department_name')
                                                <small class="text-danger">{{($message)}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            {{-- ✅ FIXED PART ONLY --}}
                                            <label for="department_description">Description</label>
                                            <textarea class="form-control" name="department_description" id="department_description" rows="4" placeholder="Enter description">{{ old('department_description') }}</textarea>
                                            @error('department_description')
                                                <small class="text-danger">{{($message)}}</small>
                                            @enderror
                                            {{-- ✅ END FIX --}}

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department_status" value="active" checked>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department_status" value="inactive">
                                        <label class="form-check-label">Inactive</label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-save"></i> SAVE
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    </section>
  </div>
@endsection
