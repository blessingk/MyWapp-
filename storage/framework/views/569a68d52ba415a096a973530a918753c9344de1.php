<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(Auth::user()->name); ?>'s DASHBOARD</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>COMPANY NAME: </strong><br><?php echo e(Auth::user()->company); ?></p>
                            <p><strong>FIRST NAME:</strong><br><?php echo e(Auth::user()->name); ?></p>
                            <p><strong>LAST NAME:</strong><br><?php echo e(Auth::user()->surname); ?></p>
                            <p><strong>MOBILE NUMBER:</strong><br><?php echo e(Auth::user()->phone); ?></p>
                            <p><strong>EMAIL ADDRESS:</strong><br><?php echo e(Auth::user()->email); ?></p>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit" data-id="<?php echo e(Auth::user()->id); ?>" data-company="<?php echo e(Auth::user()->company); ?>" data-name="<?php echo e(Auth::user()->name); ?>" data-surname="<?php echo e(Auth::user()->surname); ?>" data-phone="<?php echo e(Auth::user()->phone); ?>" data-email="<?php echo e(Auth::user()->email); ?>">
                                Update Profile
                            </button>

                        </div>
                        <div class="col-md-6">
                            <img src="/uploads/avatars/<?php echo e(Auth::user()->avatar); ?>" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                            <form enctype="multipart/form-data" action="/home" method="POST">
                                <label>Update Profile Image</label><br>
                                <input type="file" value="select image" name="avatar">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <input type="submit" value="Update Photo" class="pull-right btn btn-sm btn-primary">
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
                <h4 class="modal-title">Edit User Information</h4>
            </div>
            <form method="post" action="<?php echo e(route('user.update', 'test')); ?>">
                <?php echo e(csrf_field()); ?>

                <?php echo e(method_field('patch')); ?>

                <div class="modal-body">
                    <input type="hidden" name="id" id="user_id" value="<?php echo e(Auth::user()->id); ?>">
                    <div class="form-group row add <?php echo e($errors->has('company') ? ' has-error' : ''); ?>">
                        <label for="company" class="col-md-4 control-label">COMPANY NAME:</label>

                        <div class="col-md-6">
                            <input id="company" type="text" class="form-control" name="company" value="<?php echo e(Auth::user()->company); ?>" required>

                            <?php if($errors->has('company')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('company')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row add <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                        <label for="name" class="col-md-4 control-label">FIRST NAME:</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="<?php echo e(Auth::user()->name); ?>" required>

                            <?php if($errors->has('name')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row add <?php echo e($errors->has('surname') ? ' has-error' : ''); ?>">
                        <label for="surname" class="col-md-4 control-label">LAST NAME:</label>

                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control" name="surname" value="<?php echo e(Auth::user()->surname); ?>" required>

                            <?php if($errors->has('surname')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('surname')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row add <?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                        <label for="phone" class="col-md-4 control-label">MOBILE NUMBER:</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="<?php echo e(Auth::user()->phone); ?>" required>

                            <?php if($errors->has('phone')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row add <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                        <label for="email" class="col-md-4 control-label">EMAIL ADDRESS:</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="<?php echo e(Auth::user()->email); ?>" required>

                            <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row add <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                        <label for="email" class="col-md-4 control-label">EMAIL ADDRESS:</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" value="<?php echo e(Auth::user()->password); ?>" required>

                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                            <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>