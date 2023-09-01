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
								<li class="breadcrumb-item active" aria-current="page">roll generate</li>
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
                            <h4 class="box-title">Student <strong>Roll Generator</strong></h4>
                          </div>
        
                          <div class="box-body">
                            <form action="{{route('roll_generate.store')}}" method="post">
                                @csrf
                                <div class="row">


                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Year </h5>
                            <div class="controls">
                                <select name="year_id" id="year_id" required class="form-control">
                                    <option selected disabled >Select Year</option>
                                    @foreach ($years as $year)
                                    <option value="{{$year->id;}}">{{$year->name;}}</option>           
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
                                        <option value="{{$class->id;}}">{{$class->name;}}</option>           
                                        @endforeach

                                    </select>
                                
                                </div>
                            </div>

                        </div> <!-- End Col-md-4 -->

                                    <div class="col-md-4" style="padding-top: 25px">
                                        <a id="search" class="btn btn-primary" name="search"> Search</a>
                                    </div>  <!-- End Col-md-4 -->

                                </div>


                                {{-- Roll Generate Table --}}

                                <div class="row d-none" id="roll-generate">
                                    <div class="col-md-12">
                                       <table class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID No</th>
                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>Image</th>
                                            <th>Roll</th>
                                        </tr>
                                    </thead>
                                    <tbody id="roll-generate-tr">

                                    </tbody>
                                    </table> 
                                    </div>
                                </div>

                                <input id="roll_save" type="submit" class="btn btn-info d-none"  value="Save">


                            </form>
                          </div>
                        </div>
                      </div>

                
            </div>
        </section>


    </div>
    {{-- {{url('upload/students')}} --}}
</div>

<script type="text/javascript">
    $(document).on('click','#search',function(){
      var year_id = $('#year_id').val();
      var class_id = $('#class_id').val();
       $.ajax({
        url: "{{ route('student_registration.get_students')}}",
        type: "GET",
        data: {'year_id':year_id,'class_id':class_id},
        success: function (data) {
            $('#roll-generate').removeClass('d-none');
          $('#roll_save').removeClass('d-none');
          var html = '';
          $.each( data, function(key, v){
            html +=
            '<tr>'+
            '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
            '<td>'+v.student.name+'</td>'+
            '<td>'+v.student.fname+'</td>'+
            '<td><img width="100px" src=http://127.0.0.1:8000/upload/students/'+ v.student.image +' /></td>'+
            '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
            '</tr>';
          });
          html = $('#roll-generate-tr').html(html);
        }
      });
    });
  
  </script>



@endsection