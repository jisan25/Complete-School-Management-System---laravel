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
								<li class="breadcrumb-item active" aria-current="page">show assign subject</li>
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
                         <h3 class="box-title">Assign Subject Details</h3>
                         <a href="{{route('assign_subject.create')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Insert</a>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                        <h4><strong>Class : </strong>{{ $data[0]['get_student_class']['name'] }}</h4>
                           <div class="table-responsive">
                             <table class="table table-bordered table-striped">
                               <thead class="thead-light">
                                   <tr>
                                       <th >SL</th>
                                       <th>Subject</th>
                                       <th >Full Mark</th>
                                       <th >Pass Mark</th>
                                       <th >Subjective Mark</th>
                                   </tr>
                               </thead>
                               <tbody>
                                @foreach($data as $key => $value)
                                   <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$value['get_subject']['name']}}</td>
                                       <td>
                                        {{$value->full_mark}}
                                       </td>
                                       <td>
                                        {{$value->pass_mark}}
                                       </td>
                                       <td>
                                        {{$value->subjective_mark}}
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