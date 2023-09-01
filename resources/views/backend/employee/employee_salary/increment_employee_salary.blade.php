@extends('admin.admin_master')

@section('admin')

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
								<li class="breadcrumb-item active" aria-current="page">employee salary increment</li>
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
                 <h4 class="box-title">Employee Salary Increment</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                <form method="post" action="{{route('employee.salary.update', $data->id)}}">
                        @csrf

                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Increment Salary Amount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="increment_salary" class="form-control" required> 
                                   
                                    </div>
                                </div>
                            </div> <!-- end col-md-6 -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <h5>Effected Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="effected_salary" class="form-control" required> 
                                   
                                    </div>
                                </div>

                            </div>
                           </div>

                                

                 				
                            
                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info" value="submit"/>
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

@endsection