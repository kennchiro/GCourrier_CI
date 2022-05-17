<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?=base_url().'images/MFB.png';?>" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p>Administrateur</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a>
      </div>
    </div>


    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header" style="text-align:center;color:white;">MENU DE NAVIGATION</li>

      <br>

      <li class="active" style="font-size:14px;"><a href="">
        <i class="fa fa-home"></i>
          <span>Accueille</span>
          </a>
      </li>

      <li class="treeview">
              <a href="#" style="text-decoration:none">
                <i class="fa fa-chart-line"></i>
                <span style="font-size:14px;">Statistique</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li style="font-size:11px;"><a class = "ayam" href = "<?php echo base_url();?>welcome/Load_chartchambre"><i class="fa fa-chart-bar"></i>Chambre de commerce</a></li>
                <li style="font-size:11px;"><a class = "ayam" href = "<?php echo base_url();?>welcome/Load_chartCorr"><i class="fa fa-chart-pie"></i>Correspondance</a></li>
                <li style="font-size:11px;"><a class = "ayam" href = "<?php echo base_url();?>welcome/Load_SchoolProfile"><i class="fa fa-chart-line"></i>VISA</a></li>
                <li style="font-size:11px;"><a class = "ayam" href = "<?php echo base_url();?>welcome/Load_Subjek"><i class="fa fa-circle-o"></i>DEF | TEF</a></li>
                <li style="font-size:11px;"><a class = "ayam" href = "<?php echo base_url();?>welcome/Load_Subjek"><i class="fa fa-circle-o"></i>Statistique ensemble</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#" style="text-decoration:none">
                <i class="fa fa-envelope"></i>
                <span style="font-size:14px;" >Courriers</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li>
                <a class = "ayam" href="<?php echo base_url();?>welcome/Load_view"> <i class="fa fa-clipboard"></i> Chambre de commerce 
                </a>
              </li>

              <li>
                <a class = "ayam" href="<?php echo base_url();?>correspondance/load_view_corresp"><i class="fa fa-clipboard"></i> Correspondance
                </a>
              </li>
               
              <li>
                <a class = "ayam" href="<?php echo base_url();?>visa/load_view_visa"><i class="fa fa-clipboard"></i> VISA
                </a>
              </li>

              <li>
                <a class = "ayam" href="<?php echo base_url();?>home/Load_Register"><i class="fa fa-clipboard"></i> DEF | TEF
                </a>
              </li>

            </ul>
          </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<script type="text/javascript">


  $(document).on('click','.ayam',function(){

   var href = $(this).attr('href');
   $('#haha').empty().load(href).fadeIn('slow');
   return false;

 });


</script>






<script type="text/javascript">

  $('.apam').removeClass('active');

</script>


<script>


  $(document).ready(function(){

    $( "body" ).on( "click", ".ayam", function() {

      $('.ayam').each(function(a){
       $( this ).removeClass('selectedclass')
     });
      $( this ).addClass('selectedclass');
    });

  })


</script>




<style type="text/css">


  li a.selectedclass
  {
    color: red !important;
    font-weight: bold;
  }

</style>