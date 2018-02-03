@extends('layouts.app')

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{ route('register')}}" method="post">
        {{ csrf_field() }}
      <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" placeholder="Hospital Name" name="name" value="{{old('name')}}" required>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" placeholder="Hospital subdomain" name="slug" value="{{old('slug')}}" required>
        @if ($errors->has('slug'))
            <span class="help-block">
                <strong>{{ $errors->first('slug') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }} has-feedback">
        <input type="email" class="form-control" placeholder="Admin Email" name="email" value="{{old('email')}}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input type="password" class="form-control" placeholder="Admin Password" name="password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
      </div>
    </form>
    <a href="{{ route('login')}}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
@endsection
