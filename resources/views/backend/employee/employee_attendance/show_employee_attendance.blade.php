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
								<li class="breadcrumb-item active" aria-current="page">employee attendance</li>
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
                         <h3 class="box-title">Employee Attendance Details</h3>
                         
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                           <div class="table-responsive">
                             <table id="" class="table table-bordered table-striped">
                               <thead>
                                   <tr>
                                       <th >SL</th>
                                       <th>Name</th>
                                       <th>Id No</th>
                                       <th>Date</th>
                                       <th>Status</th>
                                     
                                   </tr>
                               </thead>
                               <tbody>
                                @foreach($data as $key => $value)
                                   <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$value->employee->name}}</td>
                                       <td>{{$value->employee->id_no}}</td>
                                       <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                       <td>{{$value->attend_status}}</td>
                                       
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