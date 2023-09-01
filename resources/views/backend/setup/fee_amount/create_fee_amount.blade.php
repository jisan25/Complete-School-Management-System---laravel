@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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
								<li class="breadcrumb-item active" aria-current="page">add fee amount</li>
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
                 <h4 class="box-title">Add Fee Amount</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{route('fee_amount.store')}}">
                        @csrf

                        <div class="add_item">

                        <div class="form-group">
                          <h5>Fee Category <span class="text-danger">*</span></h5>
                          <div class="controls">
                              <select name="fee_category_id" id="select" required class="form-control">
                                  <option selected disabled >Select Fee Category</option>
                                  @foreach ($fee_categories as $category)
                                  <option value="{{$category->id}}">{{ $category->name }}</option>                                      
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-5">
                            <div class="form-group">
                              <h5>Student Class <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <select name="class_id[]" id="select" required class="form-control">
                                      <option selected disabled >select class</option>
                                      @foreach ($classes as $class)
                                      <option value="{{$class->id}}">{{ $class->name }}</option>                                      
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          </div> <!-- end col-md-5 -->

                          <div class="col-md-5">
                            <div class="form-group">
                              <h5>Amount <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="text" name="amount[]" class="form-control" required placeholder="" value=""> 
                           
                              </div>
                          </div>
                          </div> <!-- end col-md-5 -->
                          <div class="col-md-2" style="padding-top: 25px">
                            <span  class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                          </div> <!-- end col-md-2 -->

                        </div> <!-- end row -->

                        </div> <!-- end add-item -->
                          
                            
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

<div style="visibility: hidden">
  <div class="whole_extra_item_idd" id="whole_extra_item_idd">
    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
      <div class="form-row">

        <div class="col-md-5">
          <div class="form-group">
            <h5>Student Class <span class="text-danger">*</span></h5>
            <div class="controls">
                <select name="class_id[]" id="select" required class="form-control">
                    <option selected disabled >select class</option>
                    @foreach ($classes as $class)
                    <option value="{{$class->id}}">{{ $class->name }}</option>                                      
                    @endforeach
                </select>
            </div>
        </div>
        </div> <!-- end col-md-5 -->

        <div class="col-md-5">
          <div class="form-group">
            <h5>Amount <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="text" name="amount[]" class="form-control" required placeholder="" value=""> 
         
            </div>
        </div>
        </div> <!-- end col-md-5 -->
        <div class="col-md-2" style="padding-top: 25px">
          <span  class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
          <span  class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>

        </div> <!-- end col-md-2 -->

      </div> <!-- end form row -->
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var counter = 0;
    $(document).on("click", ".addeventmore", function(){
      var whole_extra_item_idd = $('#whole_extra_item_idd').html();
      $(this).closest(".add_item").append(whole_extra_item_idd);
      counter++;
    });
    $(document).on("click", ".removeeventmore", function(event){
      $(this).closest(".delete_whole_extra_item_add").remove();
      counter-=1;
    });
  })
</script>

@endsection