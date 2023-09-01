@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full">

        {{-- Section Header --}}

        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Setup Management</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">D-PathShala</li>
								<li class="breadcrumb-item active" aria-current="page">edit employee</li>
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
                 <h4 class="box-title">Edit Employee</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{route('employee.reg.update', $data->id)}}" enctype="multipart/form-data">
                        @csrf

                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Employee Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required placeholder="" value="{{$data->name;}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Father's Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="fname" class="form-control" required placeholder="" value="{{$data->fname;}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Mother's Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mname" class="form-control" required placeholder="" value="{{$data->mname;}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->


                           </div> <!-- End Row -->

                               
                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Mobile <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mobile" class="form-control" required placeholder="" value="{{$data->mobile;}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" required placeholder="" value="{{$data->address;}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option selected disabled >Select Gender</option>
                                            <option {{ $data->gender == 'male' ? 'selected':'' }} value="male">male</option>
                                            <option {{ $data->gender == 'female' ? 'selected':'' }} value="female">female</option>
                                        </select>
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->


                           </div> <!-- End Row -->

                 				
                           <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Religion <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="religion" id="religion" required class="form-control">
                                            <option disabled >Select Religion</option>
                                            <option {{ $data['religion'] == 'islam' ? 'selected' : '' }} value="islam">islam</option>
                                            <option {{ $data['religion'] == 'sonaton' ? 'selected' : '' }} value="sonaton">sonaton</option>
                                            <option {{ $data['religion'] == 'buddha' ? 'selected' : '' }} value="buddha">buddha</option>

                                        </select>
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Date of Birth <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="dob" class="form-control" required value="{{$data['dob']}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Designation <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="designation_id" id="designation_id" required class="form-control">
                                            <option selected disabled >Select Designation</option>
                                            @foreach ($designations as $designation)
                                            <option {{ $data->designation_id == $designation->id ? 'selected' : '' }} value="{{$designation->id;}}">{{$designation->name;}}</option>           
                                            @endforeach


                                        </select>
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            


                           </div> <!-- End Row -->

                           <div class="row">

                            @if(!@$data)

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Salary <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="salary" class="form-control" required placeholder="" value="{{$data->salary;}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Joining Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="join_date" class="form-control" required value="{{$data->join_date;}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->  
                            @endif

                           </div> <!-- End Row -->

                           <div class="row">

                           
                            <div class="col-md-4">
                                
                                <div class="form-group">
                                    <h5>Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                            </div>
                            </div> <!-- End Col-md-4 -->


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Preview <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <img id="preview" src="{{  url('upload/employees/'.$data['image']) }}" alt="" style="width: 100px;border: 1px solid #000;">
                                    </div>
                            </div>

                            </div> <!-- End Col-md-4 -->

                            


                           </div> <!-- End Row -->
                            
                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info" value="update"/>
                           </div>
                       </form>
   
                   </div>
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