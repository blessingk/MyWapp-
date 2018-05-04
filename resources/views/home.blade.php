@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="col-md-12 panel-heading text-uppercase">{{ Auth::user()->name }}'s DASHBOARD</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="col-md-8 text-primary"><strong>COMPANY NAME: </strong><br>{{ Auth::user()->company }}</p>
                            <p class="col-md-8 text-primary"><strong>FIRST NAME:</strong><br>{{ Auth::user()->name }}</p>
                            <p class="col-md-8 text-primary"><strong>LAST NAME:</strong><br>{{ Auth::user()->surname }}</p>
                            <p class="col-md-8 text-primary"><strong>MOBILE NUMBER:</strong><br>{{ Auth::user()->phone }}</p>
                            <p class="col-md-8 text-primary"><strong>EMAIL ADDRESS:</strong><br>{{ Auth::user()->email }}</p>
                            <button class="col-md-6 btn btn-primary btn-md" data-toggle="modal" data-target="#edit" data-id="{{Auth::user()->id}}" data-company="{{Auth::user()->company}}" data-name="{{Auth::user()->name}}" data-surname="{{Auth::user()->surname}}" data-phone="{{Auth::user()->phone}}" data-email="{{Auth::user()->email}}">
                                Update Profile
                            </button>

                        </div>
                        <div class="col-md-6">
                            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                            <form enctype="multipart/form-data" action="/home" method="POST">
                                <label class="col-form-label-sm text-left text-primary">Update Profile Image</label><br><br>
                                <input type="file" class="btn btn-block" value="select image" name="avatar">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" value="Update Photo" class="pull-left btn btn-md btn-primary">
                            </form>
                           </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="edit" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-primary">Edit User Information</h4>
            </div>
            <form method="post" action="/update">
                {{ csrf_field() }}
                {{method_field('patch')}}
                <div class="modal-body">
                    <input type="hidden" name="id" id="user_id" value="{{ Auth::user()->id }}">
                    <div class="form-group row add {{ $errors->has('company') ? ' has-error' : '' }}">
                        <label for="company" class="col-md-4 control-label">COMPANY NAME:</label>

                        <div class="col-md-6">
                            <input id="company" type="text" class="form-control" name="company" value="{{ Auth::user()->company }}" required>

                            @if ($errors->has('company'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row add {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">FIRST NAME:</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row add {{ $errors->has('surname') ? ' has-error' : '' }}">
                        <label for="surname" class="col-md-4 control-label">LAST NAME:</label>

                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control" name="surname" value="{{ Auth::user()->surname }}" required>

                            @if ($errors->has('surname'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row add {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-4 control-label">MOBILE NUMBER:</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required>

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row add {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">EMAIL ADDRESS:</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{Auth::user()->email }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row add {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">EMAIL ADDRESS:</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" value="{{Auth::user()->password }}" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
