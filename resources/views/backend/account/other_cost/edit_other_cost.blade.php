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
								<li class="breadcrumb-item active" aria-current="page">edit other cost</li>
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
                 <h4 class="box-title">Edit Other Cost</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{route('other_cost.update', $data->id)}}" enctype="multipart/form-data">
                        @csrf

                           <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Select Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" value="{{ $data->date }}" required > 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->


                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Amount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="amount" class="form-control" required value="{{ $data->amount }}"> 
                                    
                                    </div>
                                </div>

                            </div> <!-- End Col-md-4 -->




                           </div> <!-- End Row -->

                           <div class="row">

                           
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <h5>Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                            </div>
                            </div> <!-- End Col-md-6 -->


                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Preview <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <img id="preview" src="{{  url('upload/other_cost/'.$data['image']) }}" style="width: 100px;border: 1px solid #000;">
                                    </div>
                            </div>

                            </div> <!-- End Col-md-6 -->

                            


                           </div> <!-- End Row -->

                           <div class="row">

                           
                            <div class="col-md-12">
                              
                                <div class="form-group">
                                    <h5>Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="description" id="description" class="form-control" required=""  >{{ $data->description }}</textarea>
                                    </div>
                              
                            </div> <!-- End Col-md-12 -->



                            


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