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
								<li class="breadcrumb-item active" aria-current="page">assign subject</li>
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
                 <h4 class="box-title">Assign Subject</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{route('assign_subject.store')}}">
                        @csrf

                        <div class="add_item">

                        <div class="form-group">
                          <h5>Class <span class="text-danger">*</span></h5>
                          <div class="controls">
                              <select name="class_id" id="select" required class="form-control">
                                  <option selected disabled >Select Class</option>
                                  @foreach ($classes as $class)
                                  <option value="{{$class->id}}">{{ $class->name }}</option>                                      
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-4">
                            <div class="form-group">
                              <h5>Subject <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <select name="subject_id[]" id="select" required class="form-control">
                                      <option selected disabled >Select Subject</option>
                                      @foreach ($subjects as $subject)
                                      <option value="{{$subject->id}}">{{ $subject->name }}</option>                                      
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          </div> <!-- end col-md-4 -->

                          <div class="col-md-2">
                            <div class="form-group">
                              <h5>Full Mark <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="text" name="full_mark[]" class="form-control" required> 
                           
                              </div>
                          </div>
                          </div> <!-- end col-md-2 -->

                          <div class="col-md-2">
                              <div class="form-group">
                                <h5>Pass Mark <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="pass_mark[]" class="form-control" required > 
                            
                                </div>
                            </div>
                          </div> <!-- end col-md-2 -->

                          <div class="col-md-2">
                              <div class="form-group">
                                <h5>Subjective Mark <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="subjective_mark[]" class="form-control" required> 
                            
                                </div>
                            </div>
                          </div> <!-- end col-md-2 -->


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

        <div class="col-md-4">
            <div class="form-group">
              <h5>Subject <span class="text-danger">*</span></h5>
              <div class="controls">
                  <select name="subject_id[]" id="select" required class="form-control">
                      <option selected disabled >Select Subject</option>
                      @foreach ($subjects as $subject)
                      <option value="{{$subject->id}}">{{ $subject->name }}</option>                                      
                      @endforeach
                  </select>
              </div>
          </div>
        </div> <!-- end col-md-4 -->

        <div class="col-md-2">
            <div class="form-group">
              <h5>Full Mark <span class="text-danger">*</span></h5>
              <div class="controls">
                  <input type="text" name="full_mark[]" class="form-control" required> 
            
              </div>
          </div>
        </div> <!-- end col-md-2 -->

        <div class="col-md-2">
            <div class="form-group">
              <h5>Pass Mark <span class="text-danger">*</span></h5>
              <div class="controls">
                  <input type="text" name="pass_mark[]" class="form-control" required > 
          
              </div>
          </div>
        </div> <!-- end col-md-2 -->

        <div class="col-md-2">
              <div class="form-group">
                <h5>Subjective Mark <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" name="subjective_mark[]" class="form-control" required> 
                </div>
            </div> 
        </div><!-- end col-md-2 -->

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