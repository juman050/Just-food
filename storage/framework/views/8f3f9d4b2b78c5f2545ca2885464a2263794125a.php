<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Just Food | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/AdminLTE.min.css')); ?>">
    <!-- Custom -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/fk_a_custom.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/iCheck/square/blue.css')); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo e(url('/')); ?>"><b>Just</b>Food</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to manage your food website</p>

            <?php echo Form::open(['url' => '/login','method' => 'POST','id' => 'LoginForm']); ?>


                <?php echo e(csrf_field()); ?>


                <?php if($errors->has('email')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </p>
                <?php endif; ?>

                <div class="form-group has-feedback <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <?php echo e(Form::email('email',null,['class' => 'form-control','placeholder' => 'Email'])); ?>

                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <?php echo e(Form::password('password',['class' => 'form-control','placeholder' => 'Password'])); ?>

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <?php if($errors->has('password')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </p>
                <?php endif; ?>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <?php echo e(Form::button('Login',['type' => 'submit','class' => 'btn btn-primary btn-block btn-flat'])); ?>

                    </div>
                </div>


            <?php echo Form::close(); ?>

        </div>

        <!-- jQuery 3 -->
        <script src="<?php echo e(asset('admin/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo e(asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
        <!-- validator -->
        <script src="<?php echo e(asset('common/jquery_validate/jquery.validate.min.js')); ?>"></script>
        <!-- iCheck -->
        <script src="<?php echo e(asset('admin/plugins/iCheck/icheck.min.js')); ?>"></script>

        <script>
            $(function () {

                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });


                $( "#LoginForm" ).validate({
                    rules: {
                        email: {
                            required: true,
                            email: true,           
                        },
                        password: {
                            required: true,
                            minlength: 6
                        }
                    },
                    messages: {
                        email: {
                            required: "Enter email address please !",
                            email: "Please Type valid Email",
                        },
                        password: {
                            required: "Enter password please !",
                            minlength: "Password was minimum 6 Charracters !"
                        }
                    }
                });

            });
        </script>
</body>
</html>
