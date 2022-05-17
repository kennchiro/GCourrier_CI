<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminCRUD | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
   
   <!-- Font Awesome Icons -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fontawesome-free-5.11.2-web/css/all.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fontawesome-free-5.11.2-web/css/brands.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fontawesome-free-5.11.2-web/css/ fontawesome.css" />

    <!-- Theme style -->
   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/AdminLTE.min.css" /> 
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/square-blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url(); ?>assets/index2.html"><b>Admin</b> DRCF-HM  </a>
      </div>

      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">
          Log in to start your session
        </p>

        <form action="<?php echo base_url('Auth/login'); ?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="nom">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Mot de passe" name="mdp">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!-- <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div> -->
            <div class="col-xs-offset-8 col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
            Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
            Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

        <!-- <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->

      </div>
      <!-- /.login-box-body -->
      <?php
        echo show_err_msg($this->session->flashdata('error_msg'));
      ?>
    </div>
    

    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
   
<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script> -->
    <!-- <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script> -->
  </body>
</html>
