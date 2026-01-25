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
            <h1 class="m-0">View Department</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">
                <a href="{{url('/department')}}" type="button" class="btn btn-block bg-gradient-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
            
        </div>
             
    <div class="float-right">
        {{ $departments->links('pagination::bootstrap-4') }}
    </div>
</div>

            </div>
      </div><!-- /.container-fluid -->
    </section>


  </div>

@endsection
