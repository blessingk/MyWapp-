<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('WAPP', 'WAPP')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/font-awesome.css')); ?>" rel="stylesheet">
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
                    <a class="navbar-brand" >
                        <?php echo e(config('WAPP', 'WAPP')); ?>

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
                        <?php if(auth()->guard()->guest()): ?>
                            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo e(route('admin.logout')); ?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('bootstrap/bootstrap.js')); ?>"></script>
    <script type="text/javascript">
        //adding new user
        $('#create').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            var company = button.data('company');
            var name = button.data('name');
            var surname = button.data('surname');
            var phone = button.data('phone');
            var email = button.data('email');
            var modal = $(this);
        });
        //sending email to user
        $('#myModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            var eid = button.data('id');
            var message = button.data('message');
            var email = button.data('email');
            var modal = $(this);

            modal.find('.modal-body #em_id').val(eid);
            modal.find('.modal-body #em').val(email);
            modal.find('.modal-body #message').val(message);
        });
        //editing user
        $('#edit').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            var id = button.data('id');
            var company = button.data('company');
            var name = button.data('name');
            var surname = button.data('surname');
            var phone = button.data('phone');
            var email = button.data('email');
            var modal = $(this);

            modal.find('.modal-body #user_id').val(id);
            modal.find('.modal-body #company').val(company);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #surname').val(surname);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #email').val(email);
        });
        //deleting user
        $('#delete').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            var id = button.data('did');

            var modal = $(this);

            modal.find('.modal-body #user_id').val(id);
        });
//login user
        $('#login').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            var id = button.data('lid');
            var password = button.data('lpassword');
            var email = button.data('lemail');
            var modal = $(this);

            modal.find('.modal-body #lid').val(id);
            modal.find('.modal-body #lemail').val(email);
            modal.find('.modal-body #lpassword').val(password);
        });
    </script>
</body>
</html>
