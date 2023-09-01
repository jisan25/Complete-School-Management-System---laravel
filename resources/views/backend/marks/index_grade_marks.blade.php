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
								<li class="breadcrumb-item active" aria-current="page">grade marks</li>
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
                         <h3 class="box-title">Grade Marks List</h3>
                         <a href="{{route('marks_entry.grade.create')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Insert</a>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                           <div class="table-responsive">
                             <table id="example1" class="table table-bordered table-striped">
                               <thead>
                                   <tr>
                                       <th widith="5%">SL</th>
                                       <th>Grade Name</th>
                                       <th>Grade Point</th>
                                       <th>Start Marks</th>
                                       <th>End Marks</th>
                                       <th>Point Range</th>
                                       <th>Remarks</th>
                                       <th widith="15%">Action</th>

                                   </tr>
                               </thead>
                               <tbody>
                                @foreach($data as $key => $value)
                                   <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$value->grade_name}}</td>
                                       <td>{{ number_format((float)$value->grade_point, 2) }}</td>
                                       <td>{{$value->start_marks}}</td>
                                       <td>{{$value->end_marks}}</td>
                                       <td>{{$value->start_point}} - {{$value->end_point}}</td>
                                       <td>{{$value->remarks}}</td>

                                       <td>
                                        <a href="{{route('marks_entry.grade.edit', $value->id)}}" class="btn btn-info">Edit</a>
                                      
                                       </td>
                                   </tr>
                                  @endforeach
                                  
                               </tbody>
                           
                             </table>
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