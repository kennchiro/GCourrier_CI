    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>



    <!-- print and export table -->
    <script src="<?php echo base_url('assets/exportjs/FileSaver.min.js');?> "> </script>
    <script src="<?php echo base_url('assets/exportjs/es6-promise.auto.min.js');?> "> </script>
    <script src="<?php echo base_url('assets/exportjs/html2canvas.min.js');?> "> </script>
    <script src="<?php echo base_url('assets/exportjs/jspdf.min.js');?> "> </script>
    <script src="<?php echo base_url('assets/exportjs/jspdf.plugin.autotable.js');?> "> </script>
    <script src="<?php echo base_url('assets/exportjs/tableExport.min.js');?> "> </script>


<div class="box-header with-border">

    <div class="col-md-6">
      <h3 class="box-title">Toutes les listes : </h3>
    </div>
    

    <!-- Exportation sous excel -->
    <div class="col-md-3">
 
    </div>

    <div class="col-md-3">
        <a href="<?php echo base_url('welcome/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Exporter Donnees excel</a>
        <button style="margin-top:8px;" class="form-control btn btn-default" data-toggle="modal" data-target="#myModal" id="modalimport"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Importer Donnees excel</button>
   
     <div class="container">
     <div class="dropdown">
     <button style="margin-top:8px;width:252px;margin-left:-11px;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="modalimport"> Imprimer sous</button>
     <span class="caret"></span></button>
     <ul class="dropdown-menu">
      <li><a type="button" id="pdf" href="#">PDF</a></li>
      <li><a type="button" id="csv" href="#">CSV</a></li>
      <li><a type="button" id="json" href="#">JSON</a></li>
    </ul>
  </div>
  </div>
  
  </div>    
    
     

    <div style="float:left;" class="responsive">
      <span class="pull-right">
        <button  class="btn btn-default" id = "butangBack"><i class="fa fa-arrow-left"> </i> Retour</button>
      </span>
    </div>

  </div>


<div  class="table-responsive">
<div class="box box-body">
      <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
        </tbody>
      </table>
</div>
</div>


<!-- Modal importation -->
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

//json export
$("#json").click(function () { 

$("#table").tableExport({ 
     type: 'json',
     escape: 'false',
   });
 
});

// csv export
$("#csv").click(function() {
$("#table").tableExport({
  type : 'csv',
  escape : 'false',
});

});

// pdf export
$("#pdf").click(function() {
$("#table").tableExport({
  type : 'pdf',
  escape: 'false',
  ignoreColumnText: 'A vers Z',
});

});

       $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('welcome/ajax_listViewAll')?>",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
      });
   

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
 

});
</script>