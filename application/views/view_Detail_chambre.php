

<style type="text/css">

  #buangLine{
    border: none;
    background-color: transparent;
    resize: none;
    outline: none;
  }

</style>


  <!-- Horizontal Form -->
  <div class="box-header with-border">

    <div class="col-md-6">
      <h3 class="box-title">View Detail chambre</h3>
    </div>
    
    <!-- Exportation sous excel -->
    <div class="col-md-3">
        <a href="<?php echo base_url('welcome/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Exporter Donnees excel</a>
    </div>

    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#myModal" id="modalimport"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Importer Donnees excel</button>
    </div>     

    <div style="float:left;" class="responsive">
      <span class="pull-right">
        <button  class="btn btn-default" id = "butangBack"><i class="fa fa-arrow-left"> </i>Retour</button>
      </span>
    </div>

  </div>
  <!-- /.box-header -->
  
  <!-- form start -->

 <div class="table-responsive">
 <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>IM</th>
            <th>nom</th>
            <th>dateDepot</th>
            <th>dateEnvoie</th>
            <th>dateDecision</th>
            <th>observation</th>
            <th>service</th>
            <th>numeroCompte</th>
            <th>bordereau</th>
            <th>titulaire</th>
            <th>analyse</th>
            <th>montant</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($output as $data) {
              ?>
              <tr>
                <td><?php echo $data->id; ?></td>
                <td><?php echo $data->im; ?></td>
                <td><?php echo $data->nom; ?></td>
                <td><?php echo $data->dateDepot; ?></td>
                <td><?php echo $data->dateEnvoie; ?></td>
                <td><?php echo $data->dateDecision; ?></td>
                <td><?php echo $data->observation; ?></td>
                <td><?php echo $data->service; ?></td>
                <td><?php echo $data->numeroCompte; ?></td>
                <td><?php echo $data->bordereau; ?></td>
                <td><?php echo $data->titulaire; ?></td>
                <td><?php echo $data->analyse; ?></td>
                <td><?php echo $data->montant; ?></td>
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
  </div>
 </div>
 

   

  </div>
<!-- /.box -->


<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Importation sous excel </h4>
        </div>
        <div class="modal-body">
          
        <form method="POST" action="<?php echo base_url('welcome/import'); ?>" enctype="multipart/form-data">
          <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-file"></i>
          </span>
            <input type="file" class="form-control" name="excel" aria-describedby="sizing-addon2">
          </div>
         <div class="form-group">
         <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Importer Donnees</button>
         </div>
    </div>
  </form>
        </div>
        
        <div class="modal-footer">
        <br>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

</div>




<script>
$(document).ready(function () {

  $("#modalimport").click(function () { 
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form_imp').modal('show'); // show bootstrap modal
  });

  $('#butangBack').unbind('click').click(function () {
    $.ajax({
      url : "<?php echo base_url();?>welcome/Load_view",
      success: function (result) {
        $('#haha').empty().html(result).fadeIn('slow');
      }});
  });
})
</script>

