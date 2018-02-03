@extends('admin.master')

@section('content')
<div class="row">
<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Doctor</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ session('success')}}
              </div>
            @endif
            <form method="POST" action="{{route('admin.add_doctor',['domain'=>$hospital->slug])}}">
            	{{csrf_field()}}
              <div class="box-body">
              	<div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First name" name="fname">
                  @if ($errors->has('fname'))
            		<span class="help-block">
                		<strong>{{ $errors->first('fname') }}</strong>
            		</span>
        		@endif
                </div>
                <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" name="lname">
                  @if ($errors->has('lname'))
            		<span class="help-block">
                		<strong>{{ $errors->first('lname') }}</strong>
            		</span>
        		@endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                  @if ($errors->has('email'))
            		<span class="help-block">
                		<strong>{{ $errors->first('email') }}</strong>
            		</span>
        		@endif
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label for="exampleInputPassword1">Phone number</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="e.g +23408123456789" name="phone">
                  @if ($errors->has('phone'))
            		<span class="help-block">
                		<strong>{{ $errors->first('phone') }}</strong>
            		</span>
        		@endif
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

         </div>
    </div>
@endsection