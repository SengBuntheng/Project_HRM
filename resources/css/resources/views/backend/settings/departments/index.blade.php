@extends('backend.layouts.master')
@section('title','Department')
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
            <h1 class="m-0">Department</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">
                <a href="{{url('/department/create')}}" class="btn btn-outline-primary">
                  <i class="fas fa-plus-circle"></i> Add Department
                </a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-building mr-2"></i> Department List
                </h3>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>DepartmentCode</th>
                      <th>DepartmentName</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th style="width: 15%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($departments->isEmpty())
                        <tr>
                            <td colspan="6" class="text-danger text-center">No Data found!</td>
                        </tr>
                    @else

                        @foreach($departments as $key => $value)
                            <tr>
                                <td>{{ $departments->firstItem() + $key }}</td>
                                <td>{{$value->department_code}}</td>
                                <td>{{$value->department_name}}</td>
                                <!-- <td>{{$value->description}}</td> -->
                                <td>{{ $value->department_description}}</td>
                                <td>
                                  <button type="button" class="btn btn-block btn-{{$value->department_status == 'active' ? 'success' : 'danger'}} btn-sm">{{ucfirst($value->department_status)}} </button>
                                </td>
                                <td>
                                  <a href="{{ 'department/'.$value->department_id }}" type="button" class="btn btn-outline-info"><i class="fas fa-eye"></i></a>
                                  <button type="button" class="btn btn-outline-primary"><i class="far fa-edit"></i></button>
                                  <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
    <div class="float-right">
        {{ $departments->links('pagination::bootstrap-4') }}
    </div>
</div>

            </div>
      </div><!-- /.container-fluid -->
    </section>


  </div>

@endsection
