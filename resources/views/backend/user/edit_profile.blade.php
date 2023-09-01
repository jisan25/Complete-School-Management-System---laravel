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
								<li class="breadcrumb-item active" aria-current="page">update profile</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

        {{-- end section header --}}

       
        <section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title">Edit Profile</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" value="{{$data->name}}" required > </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" value="{{$data->email}}" required > </div>
                                </div>	
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Mobile <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mobile" class="form-control" value="{{$data->mobile}}" required > </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" value="{{$data->address}}" required > </div>
                                </div>	
                            </div>
                        </div>
                            

                            <div class="form-group">
                                    <h5>Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="select" required class="form-control">
                                            <option selected="" disabled="" >select gender</option>
                                            <option  {{   $data->gender == 'male' ? 'selected' : '' }}  value="male">male</option>
                                            <option  {{   $data->gender == 'female' ? 'selected' : '' }} value="female">female</option>
                                        </select>
                                    </div>
                            </div>

                        <div class="form-group">
                                <h5>Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                        </div>

                        <div class="form-group">
                            <h5>Preview <span class="text-danger">*</span></h5>
                            <div class="controls">
                               <img id="preview" src="{{ (!empty($data->image)) ? url('upload/users/'.$data->image) : url('upload/no_image.jpg') }}" alt="" style="width: 200px;border: 1px solid #000;">
                            </div>
                    </div>

                             

                        				
                            
                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info" value="Update"/>
                           </div>
                       </form>
   
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
   
           </section>


    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#preview').attr('src', e.target.result)
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
    </script>

@endsection