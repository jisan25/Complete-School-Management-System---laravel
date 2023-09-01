@extends('admin.admin_master')

@section('admin')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="content-wrapper">
    <div class="container-full">

        {{-- Section Header --}}

        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Student Management</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">D-PathShala</li>
								<li class="breadcrumb-item active" aria-current="page">student reg</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

        {{-- end section header --}}

        <section class="content">
            <div class="row">

                    <div class="col-md-12">
                        <div class="box bb-3 border-warning">
                          <div class="box-header">
                            <h4 class="box-title">Student <strong>Search</strong></h4>
                          </div>
        
                          <div class="box-body">
                            <form action="{{route('student.filter')}}" method="get">
                                <div class="row">


                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Year </h5>
                            <div class="controls">
                                <select name="year_id" id="year_id" required class="form-control">
                                    <option selected disabled >Select Year</option>
                                    @foreach ($years as $year)
                                    <option value="{{$year->id;}}" {{($year_id == $year->id) ? 'selected' : ''}}>{{$year->name;}}</option>           
                                    @endforeach


                                </select>
                            
                            </div>
                        </div>

                    </div> <!-- End Col-md-4 -->
        
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Class</h5>
                                <div class="controls">
                                    <select name="class_id" id="class_id" required class="form-control">
                                        <option selected disabled >Select Class</option>
                                        @foreach ($classes as $class)
                                        <option value="{{$class->id;}}"  {{($class_id == $class->id) ? 'selected' : ''}}>{{$class->name;}}</option>           
                                        @endforeach

                                    </select>
                                
                                </div>
                            </div>

                        </div> <!-- End Col-md-4 -->

                                    <div class="col-md-4" style="padding-top: 25px">
                                        <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search" value="Search">
                                    </div>  <!-- End Col-md-4 -->

                                </div>
                            </form>
                          </div>
                        </div>
                      </div>

                <div class="col-12">

                    <div class="box">
                       <div class="box-header with-border">
                         <h3 class="box-title">Student List</h3>
                         <a href="{{route('student_registration.create')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add Student</a>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                           <div class="table-responsive">
                            @if(!@$search)
                             <table id="example1" class="table table-bordered table-striped">
                               <thead>
                                   <tr>
                                       <th width="5%">SL</th>
                                       <th>Name</th>
                                       <th>ID No</th>
                                       <th>Roll</th>
                                       <th>Year</th>
                                       <th>Class</th>
                                       <th>Image</th>
                                       @if(Auth::user()->role == 'admin')
                                       <th>Code</th>
                                       @endif
                                       <th width="25%">Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                @foreach($assignStudentData as $key => $value)
                                   <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{ $value['student']['name']; }}</td>
                                       <td>{{ $value['student']['id_no']; }}</td>
                                       <td>{{ $value->roll; }}</td>
                                       <td>{{ $value['student_year']['name'] }}</td>
                                       <td>{{ $value['student_class']['name'] }}</td>
                                       <td>
                                        <img src="{{ (!empty($value['student']['image'])) ? url('upload/students/'.$value['student']['image']) : url('upload/no_image.jpg') }}" style="width:60px;">
                                       </td>
                                       <td>{{ $value['student']['code']; }}</td>
                                       <td>
                                            <a title="edit" href="{{route('student_registration.edit', $value->student_id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a title="promote" id="promote" href="{{route('student_registration.promote', $value->student_id)}}" class="btn btn-success"><i class="fa fa-check"></i></a>
                                            <a target="_blank" title="details" id="show" href="{{route('student_registration.show', $value->student_id)}}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                       </td>
                                   </tr>
                                  @endforeach
                                  
                               </tbody>
                           
                             </table>
                             @else
                             <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th>Name</th>
                                        <th>ID No</th>
                                        <th>Roll</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Image</th>
                                        @if(Auth::user()->role == 'admin')
                                        <th>Code</th>
                                        @endif
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
            @foreach($assignStudentData as $key => $value)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $value['student']['name']; }}</td>
                <td>{{ $value['student']['id_no']; }}</td>
                <td>{{ $value->roll; }}</td>
                <td>{{ $value['student_year']['name'] }}</td>
                <td>{{ $value['student_class']['name'] }}</td>
                <td>
                    <img src="{{ (!empty($value['student']['image'])) ? url('upload/students/'.$value['student']['image']) : url('upload/no_image.jpg') }}" style="width:60px;">
                </td>
                <td>{{ $value['student']['code']; }}</td>
                <td>
                    <a title="edit" href="{{route('student_registration.edit', $value->student_id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a title="promote" id="promote" href="{{route('student_registration.promote', $value->student_id)}}" class="btn btn-success"><i class="fa fa-check"></i></a>
                    <a target="_blank" title="details" id="show" href="{{route('student_registration.show', $value->student_id)}}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
                                   
                                </tbody>
                            
                              </table>
                             @endif
                           </div>
                       </div>
                       <!-- /.box-body -->
                     </div>
                     <!-- /.box -->
       
                    
                     <!-- /.box -->          
                   </div>
            </div>
        </section>


    </div>
</div>



@endsection