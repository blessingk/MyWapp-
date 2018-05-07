@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="col-md-12 panel-heading text-uppercase">{{ Auth::user()->name }}'s DASHBOARD</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="col-md-8 text-primary"><strong>NAME: </strong><br>{{ Auth::user()->name }}</p>
                                <p class="col-md-8 text-primary"><strong>JOB TITLE:</strong><br>{{ Auth::user()->job_title }}</p>
                                <p class="col-md-8 text-primary"><strong>EMAIL ADDRESS:</strong><br>{{ Auth::user()->email }}</p>
                                <button class="col-md-6 btn btn-primary btn-md" data-toggle="modal" data-target="#editAdmin" data-id="{{Auth::user()->id}}" data-name="{{Auth::user()->name}}" data-email="{{Auth::user()->email}}" data-job="{{Auth::user()->job_title}}">
                                    Update Profile
                                </button>

                            </div>
                            <div class="col-md-6"><button class="col-md-6 btn btn-success btn-md" data-toggle="modal" data-target="#createAdmin" data-id="{{Auth::user()->id}}" data-name="{{Auth::user()->name}}" data-email="{{Auth::user()->email}}" data-job="{{Auth::user()->job_title}}">
                                    New Admin
                                </button><a href="{{url('admin')}}" class="col-md-3 btn btn-primary btn-md" >
                                       BACK
                                    </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="editAdmin" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-primary">Update Information</h4>
                </div>
                <form method="post" action="{{route('profile.update', 'test')}}">
                    {{ csrf_field() }}
                    {{method_field('patch')}}
                    <div class="modal-body">
                        <input type="hidden" name="id" id="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group row add {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">NAME:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row add {{ $errors->has('job_title') ? ' has-error' : '' }}">
                            <label for="job_title" class="col-md-4 control-label">JOB TITLE:</label>

                            <div class="col-md-6">
                                <input id="job_title" type="text" class="form-control" name="job_title" value="{{ Auth::user()->job_title }}" required>

                                @if ($errors->has('job_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="createAdmin" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-primary">Create New Admin</h4>
                </div>
                <form method="post" action="{{route('profile.store')}}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group row add {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">ADMIN NAME:</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row add {{ $errors->has('job_title') ? ' has-error' : '' }}">
                            <label for="job_title" class="col-md-4 control-label">JOB TITLE:</label>

                            <div class="col-md-6">
                                <input id="job-title" type="text" class="form-control" name="job_title" value="" required>

                                @if ($errors->has('job_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row add {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">EMAIL ADDRESS:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">ADD ADMIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
