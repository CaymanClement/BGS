@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Choose Title</label>

                            <div class="col-md-6">
                                <select id="title" class="form-control" name="title" required autofocus>
                                   <option value="{{ old('title') }}">{{ old('title') }}</option>
                                   <option value="HFA">HFA</option>
                                   <option value="PFA">PFA</option>
                                   <option value="DGM">DGM</option>
                                   <option value="GM">General Manager</option>
                                   <option value="System Admin">System Admin</option>
                                   <option value="Staff">Staff</option>
                                 </select>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('branch_name') ? ' has-error' : '' }}">
                            <label for="branch_name" class="col-md-4 control-label">Choose Branch Name</label>

                            <div class="col-md-6">
                                <select id="branch_name" class="form-control" name="branch_name" value="{{ old('branch_name') }}" required autofocus>
                                   <option value="{{ old('branch_name') }}">{{ old('branch_name') }}</option>
                                    @foreach($list_branches as $list)
                                    <option value="{{ $list->branch_id }}">{{ $list->b_name }}</option>
                                    @endforeach
                                 </select>

                                @if ($errors->has('branch_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('branch_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    Register
                                </button><br><br>
                                <h5><b><u>Password Rules:</u></b></h5>
                                <span>Your password has to be at least 6 characters long.
                                    <br>Must contain at least one lower case letter
                                    <br>One upper case letter
                                    <br>One Number.
                                    <br>And one of these special characters ~!@#$%^&*()_+</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
