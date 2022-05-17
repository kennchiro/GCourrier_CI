<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>





<!DOCTYPE html>


<html>
<head>
  <style type="text/css">

  .un {text-decoration: none; }


  </style>


  <script src="<?php echo base_url();?>assets/js/jquery-1.11.2.min.js"></script> 

  <script type = "text/javascript" src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>


  <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/AdminLTE.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/skin-green.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />

  <meta charset="UTF-8">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
 
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fontawesome-free-5.11.2-web/css/all.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fontawesome-free-5.11.2-web/css/brands.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fontawesome-free-5.11.2-web/css/ fontawesome.css" />

</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      
      <!-- Logo -->
      <a href="" style="text-decoration:none" class="un logo"><b>DGCF</b></a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">


            <!-- User Account Menu -->
            <li class="dropdown user user-menu">

             <!-- Menu Toggle Button -->
             <a href="<?php echo base_url(); ?>assets/#" class="dropdown-toggle" data-toggle="dropdown"> 
              <!-- The user image in the navbar-->
              <img src="<?=base_url().'images/icons8_User.ico';?>" class="user-image" alt="User Image">
               <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> </span>
              </a>
              
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
            <img  src="<?=base_url().'images/profil.png';?>"  class="img-circle" alt="User Image">

            <p>
             name of - Web Developer
              <small>Member since Sep. 2016</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a id="profile" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="<?php echo site_url('welcome/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
            </li>
          </ul>
        </div>
      </nav>

    </header>

    <?php $this->load->view('navigation_bar');?>      

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content-header">
        <h1>
           
          <small>DRCF-HM | Courrier </small>
        </h1>

      </section>

             

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
               <!--     <h3 class="box-title">Data Contractor</h3>-->
             </div><!-- /.box-header -->
             <div class="box-body">
            
              <!-- Main content -->
              <section class="content">
              <?php $this->load->view('count'); ?>
                <!-- Your Page Content Here -->
               
                <br><br><br>
                <br><br><br>
                <br><br><br>
                <?php $this->load->view('content'); ?>


              </section><!-- /.content -->
            </div><!-- /.content-wrapper -->



          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">

    </div>
    <!-- Default to the left --> 
    <strong>Copyright &copy; 2016 <a href="#">SEMSAS</a>.</strong> All rights reserved.
  </footer>

</div><!-- ./wrapper -->



<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>

  <script>
 
 $(document).ready(function () {
  $("#profile").click(function () { 
       
       $.ajax({
         type: "POST",
         url: "<?php echo site_url('Profil');?>",
         success: function (result) {
          $('#count').empty().html(result).fadeIn('slow');
          $('#haha').empty()
         }

       });

     });
 });
    

  </script>

</body>
</html>