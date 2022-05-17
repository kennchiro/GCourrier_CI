<style type="text/css">

  #buangLine{
    border: none;
    background-color: transparent;
    resize: none;
    outline: none;
  }

</style>

<?php foreach ($output as $data): ?>
  <!-- Horizontal Form -->
  <div class="box-header with-border">

    <div class="col-md-6">
      <h3 class="box-title">View Detail C | correspondance</h3>
    </div>

    <!-- Exportation sous excel -->
    <div class="col-md-3">
        <a href="<?php echo base_url('correspondance/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Exporter Donnees excel</a>
    </div>

    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#mode"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Importer Donnees excel</button>
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
            <th>observation</th>
            <th>service_direction</th>
            <th>nature</th>
            <th>bordereau</th>
            <th>analyse</th>
            <th>ministere</th>
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
                <td><?php echo $data->observation; ?></td>
                <td><?php echo $data->service_direction; ?></td>
                <td><?php echo $data->nature; ?></td>
                <td><?php echo $data->bordereau; ?></td>
                <td><?php echo $data->analyse; ?></td>
                <td><?php echo $data->ministere; ?></td>
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
  </div>
 </div>
 

    <?php endforeach; ?>

  </div>
<!-- /.box -->



<script>
$(document).ready(function () {

  $('#butangBack').unbind('click').click(function () {
    $.ajax({
      url : "<?php echo base_url();?>correspondance/load_view_corresp",
      success: function (result) {
        $('#haha').empty().html(result).fadeIn('slow');
      }});
  })
})
</script>

