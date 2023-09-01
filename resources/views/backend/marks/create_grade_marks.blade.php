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
								<li class="breadcrumb-item active" aria-current="page">add grade marks</li>
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
                 <h4 class="box-title">Add Grade Marks</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{route('marks_entry.grade.store')}}">
                        @csrf

                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Grade Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_name" class="form-control" required placeholder="" value=""> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Grade Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_point" class="form-control" required placeholder="" value=""> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Start Marks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_marks" class="form-control" required placeholder="" value=""> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->


                           </div> <!-- End Row -->

                               
                    <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>End Marks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_marks" class="form-control" required placeholder="" value=""> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Start Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_point" class="form-control" required placeholder="" value=""> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->

                          
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>End Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_point" class="form-control" required placeholder="" value=""> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->


                           </div> <!-- End Row -->

                 				
                           <div class="row">



                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Remarks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="remarks" class="form-control" required placeholder="" value=""> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->
                    </div> <!-- End Row -->
                            
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