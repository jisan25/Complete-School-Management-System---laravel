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
								<li class="breadcrumb-item active" aria-current="page">employee salary list</li>
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
                         <h3 class="box-title">Employee Salary List</h3>
                         <a href="{{route('employee.reg.create')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Insert</a>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                           <div class="table-responsive">
                             <table id="example1" class="table table-bordered table-striped">
                               <thead>
                                   <tr>
                                       <th widith="5%">SL</th>
                                       <th>Name</th>
                                       <th>ID No</th>
                                       <th>Mobile</th>
                                       <th>Gender</th>
                                       <th>Join Date</th>
                                       <th>Salary</th>

                                       <th widith="20%">Action</th>

                                   </tr>
                               </thead>
                               <tbody>
                                @foreach($data as $key => $value)
                                   <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$value->name}}</td>
                                       <td>{{$value->id_no}}</td>
                                       <td>{{$value->mobile}}</td>
                                       <td>{{$value->gender}}</td>
                                       <td>{{ date('d-m-Y', strtotime($value->join_date)) }}</td>
                                       <td>{{$value->salary}}</td>
                                      
                                       <td>
                                        <a title="increment" href="{{route('employee.salary.increment', $value->id)}}" class="btn btn-info"><i class="fa fa-plus-circle"></i></a>
                                        <a title="details" target="_blank" href="{{route('employee.salary.show', $value->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
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