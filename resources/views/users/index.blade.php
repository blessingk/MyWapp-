@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h3>ADMIN DASHBOARD</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
    <div class="table table-responsive">
        <table class="table table-bordered" id="table">
            <tr>
                <th>NO</th>
                <th>CLIENT NAME</th>
                <th>EMAIL</th>
                <th>PHONE NUMBER</th>
                <th class="text-center">
                    <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#create">
                        New User
                    </button>
                </th>
            </tr>
            {{ csrf_field() }}
            <?php $no=1; ?>
            @foreach($user as $value)
                <tr>
                    <td>{{$value['id']}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['email']}}</td>
                    <td>{{$value['phone']}}</td>
                    <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit" data-id="{{$value->id}}" data-company="{{$value->company}}" data-name="{{$value->name}}" data-surname="{{$value->surname}}" data-phone="{{$value->phone}}" data-email="{{$value->email}}">
                            Edit
                        </button>
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myModal" data-eid="{{$value->id}}" data-email="{{$value->email}}">
                            Mail
                        </button>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#login" data-lid="{{$value->id}}" data-lemail="{{$value->email}}" data-lpassword="{{$value->password}}">
                            Login
                        </button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" data-did="{{$value->id}}" data-dname="{{$value->name}}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
</div>
<!--modal to create new user-->
    <div id="create" class="modal fade" role="dialog" tabindex="1" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New User</h4>
                </div>
                <form  method="post" action="{{route('user.store')}}">
                    {{ csrf_field() }}
                <div class="modal-body">
                        <div class="form-group row add">
                            <label for="comp" class="col-md-4 control-label">COMPANY NAME:</label>

                            <div class="col-md-6">
                                <input id="comp" type="text" class="form-control" name="company" required>
                            </div>
                        </div>
                        <div class="form-group row add {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="fname" class="col-md-4 control-label">FIRST NAME:</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control" name="name" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row add {{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="sname" class="col-md-4 control-label">LAST NAME:</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control" name="surname" required>

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
                                <input id="phone" type="text" class="form-control" name="phone" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row add{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">EMAIL ADDRESS:</label>

                            <div class="col-md-6">
                                <input id="mail" type="email" class="form-control" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class=" btn btn-primary">
                        ADD USER
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!--user details modal-->
<div id="edit" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit User Information</h4>
            </div>
            <form method="post" action="{{route('user.update', 'test')}}">
                {{ csrf_field() }}
                {{method_field('patch')}}
            <div class="modal-body">
                <input type="hidden" name="id" id="user_id" value="{{ $value->id }}">
                    <div class="form-group row add {{ $errors->has('company') ? ' has-error' : '' }}">
                        <label for="company" class="col-md-4 control-label">COMPANY NAME:</label>

                        <div class="col-md-6">
                            <input id="company" type="text" class="form-control" name="company" value="{{ $value->company }}" required>

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
                            <input id="name" type="text" class="form-control" name="name" value="{{ $value->name }}" required>

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
                            <input id="surname" type="text" class="form-control" name="surname" value="{{ $value->surname }}" required>

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
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $value->phone }}" required>

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
                            <input id="email" type="email" class="form-control" name="email" value="{{ $value->email }}" required>

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
    <!--email modal-->
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send Email to user</h4>
            </div>
            <form method="post" >
                {{ csrf_field() }}
                <input type="hidden" name="id" id="em_id" value="">
            <div class="modal-body">
                            <input id="em" type="hidden" class="form-control" value="{{ $value->email }}"  name="email" required>
                    <div class="form-group row" >
                        <label for="message" class="col-md-3 control-label">Message:</label>
                        <div class="col-md-8">
                            <textarea id="message" rows="8" type="text" class="form-control" name="message" required></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                   SEND MAIL
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--delete modal-->
<div id="delete" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete User</h4>
            </div>
            <form method="post" action="{{route('user.destroy', 'test')}}">
                {{ csrf_field() }}
                {{method_field('delete')}}
            <div class="modal-body">
                <input type="hidden" name="id" id="user_id" value="">
                <p class="text-center"> Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">
                   No, Cancel
                </button>
                <button type="submit" class="btn btn-danger">
                    Yes, DELETE
                </button>
            </div>
            </form>
        </div>

    </div>
</div>
<div id="login" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login User</h4>
            </div>
            <form method="post" action="{{route('loginUser.submit')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="id" id="lid" value="{{$value->id}}"><br>
                    <input type="hidden" name="email" id="lemail" value="{{$value->email}}"><br>
                    <input type="hidden" name="password" id="lpassword" value="{{$value->password}}">
                    <p class="text-center"> Are you sure you want to login into this user's account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">
                        No, Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        Yes, LOGIN
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection