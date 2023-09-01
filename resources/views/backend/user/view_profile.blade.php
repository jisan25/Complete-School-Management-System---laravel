@extends('admin.admin_master')

@section('admin')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="content-wrapper">
    <div class="container-full">

        {{-- Section Header --}}

        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Profile Management</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">D-PathShala</li>
								<li class="breadcrumb-item active" aria-current="page">profile</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

        {{-- end section header --}}

        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                       <div class="box-header with-border">
                         <h3 class="box-title">View User Profile</h3>
                         <a href="{{route('profile.edit')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Edit</a>
                       </div>
          
                     </div>
                     <!-- /.box -->
                     <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black">
                          <h3 class="widget-user-username">{{$data->name}}</h3>
                          <h6 class="widget-user-desc">{{$data->usertype}}</h6>
                          <h6 class="widget-user-desc">{{$data->email}}</h6>
                        </div>
                        <div class="widget-user-image">
                          <img class="rounded-circle" src="{{ (!empty($data->image)) ? url('upload/users/'.$data->image) : url('upload/no_image.jpg') }}" alt="User Avatar">
                        </div>
                        <div class="box-footer">
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="description-block">
                                <h5 class="description-header">Mobile</h5>
                                <span class="description-text">{{$data->mobile}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 br-1 bl-1">
                              <div class="description-block">
                                <h5 class="description-header">Address</h5>
                                <span class="description-text">{{$data->address}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                              <div class="description-block">
                                <h5 class="description-header">Gender</h5>
                                <span class="description-text">{{$data->gender}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                      </div>
                    
                     <!-- /.box -->          
                   </div>
            </div>
        </section>


    </div>
</div>



@endsection