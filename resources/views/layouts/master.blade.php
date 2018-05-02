<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('WAPP', 'WAPP') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('user.index') }}">
                    {{ config('WAPP', 'WAPP') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('bootstrap/bootstrap.js') }}"></script>
<script type="text/javascript">
    $(document).on('click','.create-modal', function () {
        $('#create').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('Add New User');
    })
    //adding new user
    $("#add").click(function(){
        $.ajax({
            type : 'POST',
            url : 'addUser',
            data : {
                '_token': $('input[name=_token]').val(),
                'company': $('input[name=company]').val(),
                'name': $('input[name=name]').val(),
                'surname': $('input[name=surname]').val(),
                'phone': $('input[name=phone]').val(),
                'email': $('input[name=email]').val(),
            },
            success: function(data) {
                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.company);
                    $('.error').text(data.errors.name);
                    $('.error').text(data.errors.surname);
                    $('.error').text(data.errors.phone);
                    $('.error').text(data.errors.email);
                }else {
                    $('.error').remove();
                    $('#table').append("<tr class='user" + data.id + "'>"+
                        "<td>" + data.id + "</td>"+
                        "<td>" + data.name + "</td>"+
                        "<td>" + data.email + "</td>"+
                        "<td>" + data.phone + "</td>"+
                        "<td><a class='show-modal btn btn-info btn-sm' data-id= '" + data.id +"' data-name='" + data.name + "' data-email='" + data.email + "'>" +
                        "<i class='glyphicon glyphicon-eye-open'></i>"+
                        "<a class='edit-modal btn btn-warning btn-sm' data-id= '" + data.id +"' data-name='" + data.name + "' data-email='" + data.email + "'>" +
                        "<i class='glyphicon glyphicon-pencil'></i>"+
                        "<a class='delete-modal btn btn-danger btn-sm' data-id= '" + data.id +"' data-name='" + data.name + "' data-email='" + data.email + "'>" +
                        "<i class='glyphicon glyphicon-trash'></i>"+
                        "</td>" +
                        "</tr>");
                }
            }
        });
    });
    $('name').val('');
    $('email').val('');
    $('surname').val('');
    $('phone').val('');
    $('company').val('');

    // editing user
    $(document).on('click', '.edit-modal', function () {
        $('#footer_action_button').text('Update User');
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit User Information');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#id').val($(this).data('id'));
        $('#company').val($(this).data('company'));
        $('#name').val($(this).data('name'));
        $('#surname').val($(this).data('surname'));
        $('#phone').val($(this).data('phone'));
        $('#email').val($(this).data('email'));
        $('#edit').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            type: 'POST',
            url: 'editUser',
            data: {
                '_token': $('input[name=_token]').val(),
                'company': $("#company").val(),
                'name': $("#name").val(),
                'surname': $("#surname").val(),
                'phone': $("#phone").val(),
                'email': $("#email").val(),
            },
            success:function (data) {
                $('.users' + data.id).replacewith("" +
                    "<tr class='user" + data.id + "'>"+
                    "<td>" + data.id + "</td>"+
                    "<td>" + data.name + "</td>"+
                    "<td>" + data.email + "</td>"+
                    "<td>" + data.phone + "</td>"+
                    "<td><a class='show-modal btn btn-info btn-sm' data-id= '" + data.id +"' data-name='" + data.name + "' data-email='" + data.email + "'>" +
                    "<i class='glyphicon glyphicon-eye-open'></i>"+
                    "<a class='edit-modal btn btn-warning btn-sm' data-id= '" + data.id +"' data-name='" + data.name + "' data-email='" + data.email + "'>" +
                    "<i class='glyphicon glyphicon-pencil'></i>"+
                    "<a class='delete-modal btn btn-danger btn-sm' data-id= '" + data.id +"' data-name='" + data.name + "' data-email='" + data.email + "'>" +
                    "<i class='glyphicon glyphicon-trash'></i>"+
                    "</td>" +
                    "</tr>");
            }
        });
    });

</script>
<script type="text/javascript">
    $(document).on('click','.show-modal', function () {
        $('#show').modal('show');
        $('.modal-title').text('User Details');

    });

    $(document).on('click','.email-modal', function () {
        $('#email').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('Send Email');

    });

    $(document).on('click','.delete-modal', function () {
        $('#delete').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('Delete User');

    });

</script>
</body>
</html>
