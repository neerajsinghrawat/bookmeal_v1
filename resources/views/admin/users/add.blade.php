@extends('layouts.admin')

@section('content')
 <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add User
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i><b class="a_tag_color">Home</b></a></li>
        <li><a href="{{ URL::to('admin/users') }}" ><b class="a_tag_color">User Manager</b></a></li>
        <li><b >Add User</b></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('admin.users.add.post') }}" enctype="multipart/form-data" method="POST" >
             {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" class="form-control" name="first_name" placeholder="Enter First name" required="required">
                   @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                </div> 

                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required="required">
                  @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Enter Email" required="required">
                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter Password" required="required">
                  @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" required="required">
                  @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">Phone No.</label>
                  <input type="number" class="form-control" name="phone" placeholder="Enter Phone No." required="required">
                  @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                </div>    

                <div class="form-group">
                  <label for="exampleInputEmail1">Group</label>
                   <select name="group_id" class="form-control">
                     <option value="0">-Select Group-</option>
                     @foreach($group_list as $group)
                      <option value="{{ $group->id }}">{{ ucwords($group->name)}}</option>
                     @endforeach
                   </select>

                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Status</label>
                   <input type="checkbox" name="activated">
                </div>
        
        
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submitbutton" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

         
        </div>
        
      </div>
      <!-- /.row -->
    </section>


  
@endsection


