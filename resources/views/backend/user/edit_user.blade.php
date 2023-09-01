@extends('admin.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">

        {{-- Section Header --}}

        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">User Management</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">D-PathShala</li>
								<li class="breadcrumb-item active" aria-current="page">edit user</li>
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
                 <h4 class="box-title">Edit User</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{route('user.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Select Role <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="role" id="role" required class="form-control">
                                            <option selected="" disabled="" >Select Role</option>
                                            <option  {{   $data->role == 'admin' ? 'selected' : '' }}  value="admin">admin</option>
                                            <option  {{   $data->role == 'operator' ? 'selected' : '' }} value="operator">operator</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" value="{{$data->name}}" required > </div>
                                </div>
                            </div>

                        </div>
                       <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Email <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="email" name="email" class="form-control" value="{{$data->email}}" required > </div>
                        </div>
                        </div>       
                    </div>					
                            
                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info" value="Update"/>
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