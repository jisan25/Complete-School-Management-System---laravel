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
								<li class="breadcrumb-item active" aria-current="page">promote student</li>
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
                 <h4 class="box-title">Promote Student</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{route('student_registration.update_promote', $data->student_id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required placeholder="" value="{{$data['student']['name']}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Father's Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="fname" class="form-control" required placeholder="" value="{{$data['student']['fname']}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Mother's Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mname" class="form-control" required placeholder="" value="{{$data['student']['mname']}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->


                           </div> <!-- End Row -->

                               
                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Mobile <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mobile" class="form-control" required placeholder="" value="{{$data['student']['mobile']}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" required placeholder="" value="{{$data['student']['address']}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option disabled >Select Gender</option>
                                            <option {{ $data['student']['gender'] == 'male' ? 'selected' : '' }} value="male">male</option>
                                            <option {{ $data['student']['gender'] == 'female' ? 'selected' : '' }} value="female">female</option>
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
                                            <option {{ $data['student']['religion'] == 'islam' ? 'selected' : '' }} value="islam">islam</option>
                                            <option {{ $data['student']['religion'] == 'sonaton' ? 'selected' : '' }} value="sonaton">sonaton</option>
                                            <option {{ $data['student']['religion'] == 'buddha' ? 'selected' : '' }} value="buddha">buddha</option>

                                        </select>
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Date of Birth <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="dob" class="form-control" value="{{$data['student']['dob']}}" required > 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Discount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount" class="form-control" required placeholder="" value="{{$data['discount']['discount']}}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            


                           </div> <!-- End Row -->

                           <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Year <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="year_id" id="year_id" required class="form-control">
                                            <option disabled >Select Year</option>
                                            @foreach ($years as $year)
                                            <option value="{{$year->id;}}" {{ $data->year_id == $year->id ? 'selected' : '' }}>{{$year->name;}}</option>           
                                            @endforeach


                                        </select>
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Class <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_id" id="class_id" required class="form-control">
                                            <option disabled >Select Class</option>
                                            @foreach ($classes as $class)
                                            <option value="{{$class->id;}}" {{ $data->class_id == $class->id ? 'selected' : '' }}>{{$class->name;}}</option>           
                                            @endforeach

                                        </select>
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Group <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="group_id" id="group_id" required class="form-control">
                                            <option disabled >Select Group</option>
                                            @foreach ($groups as $group)
                                            <option value="{{$group->id;}}" {{ $data->group_id == $group->id ? 'selected' : '' }}>{{$group->name;}}</option>           
                                            @endforeach

                                        </select>
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            


                           </div> <!-- End Row -->

                           <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Shift <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="shift_id" id="shift_id" required class="form-control">
                                            <option disabled >Select Shift</option>
                                            @foreach ($shifts as $shift)
                                            <option value="{{$shift->id;}}" {{ $data->shift_id == $shift->id ? 'selected' : '' }}>{{$shift->name;}}</option>           
                                            @endforeach


                                        </select>
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

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
                                       <img id="preview" src="{{  url('upload/students/'.$data['student']['image']) }}" alt="" style="width: 100px;border: 1px solid #000;">
                                    </div>
                            </div>

                            </div> <!-- End Col-md-4 -->

                            


                           </div> <!-- End Row -->
                            
                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info" value="promote"/>
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