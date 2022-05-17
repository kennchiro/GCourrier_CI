

<style type="text/css">

#buangLine{
  border: none;
  background-color: transparent;
  resize: none;
  outline: none;
}

</style>


<center>  <h4> Resultat de la recherche de date </h4> </center> 
<!-- Horizontal Form -->

<!-- /.box-header -->

<!-- form start -->
<a type="button" href="<?php echo site_url('correspondance/load_view_corresp');?>" class="btn btn-default" id = "butangBack"><i class="fa fa-arrow-left"> </i> Retour</a>
<br>
<br>

<div class="row">

  <div class="col-md-3">
    <input style="width:300px; " placeholder="rechercher" type="search" name="search" id="searchInput" class="form-control"  required="required">
  </div>

</div>


<br>
<div class="table-responsive">

<div class="box box-body">
    <table id="tabel-detail" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>IM</th>
          <th>Nom</th>
          <th>Date de depot</th>
          <th>Date d'envoie</th>
          <th>Observation</th>
          <th>Service direction</th>
          <th>Nature</th>
          <th>Bordereau</th>
          <th>Analyse</th>
          <th>Ministere</th>
        </tr>
      </thead>
      <tbody  id="fbody">
        <?php
          foreach ($output as $data) {
            ?>
            <tr>
              <td>
                <input type="checkbox" class="form-check-input" name="checkbox_value" id="delete_checkbox" value="<?php echo $data->id; ?>">
              </td>
              <td><?php echo $data->id; ?></td>
              <td><?php echo $data->im; ?></td>
              <td><?php echo $data->nom; ?></td>
              <td class="bg-green"><?php echo $data->dateDepot; ?></td>
              <td class="bg-red"><?php echo $data->dateEnvoie; ?></td>
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
</div>
<!-- /.box -->



<script>
$(document).ready(function () {


  
   //active checkbox
   $('.delete_checkbox').click(function() {
       if($(this).is(':checked'))
       {
         $(this).closest('tr').addClass('removeRow');
       } 
       else
       {
         $(this).closest('tr').removeClass('removeRow');
       }
     });


     $("#delete_all").on('click',function() { 
        var checkbox = $('#delete_checkbox:checked');
        if(checkbox.length > 0)
        {
          var checkbox_value = [];
          $(checkbox).each(function() {
            checkbox_value.push($(this).val());
          });
          $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>welcome/delete_all",
            data: {checkbox_value: checkbox_value},
            success: function () {
            
             $('.removeRow').fadeOut(1300); 
             window.location.reload(false);
            }
          })
        }
        else
        {
          alert('select at least one records')
        }
       
     });

     //////


    $("#searchInput").keyup(function () {
    // Split the current value of the filter textbox
    var data = this.value.split(" ");
    // Get the table rows
    var rows = $("#fbody").find("tr");
    if (this.value == "") {
        rows.show();
        return;
    }
    
    // Hide all the rows initially
    rows.hide();

    // Filter the rows; check each term in data
    rows.filter(function (i, v) {
        for (var d = 0; d < data.length; ++d) {
            if ($(this).is(":contains('" + data[d] + "')")) {
                return true;
            }
        }
        return false;
    })
    // Show the rows that match.
    .show();
}).focus(function () { // style the filter box
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
}).css({
    "color": "#C0C0C0"
});


$.expr[":"].contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});


})
</script>

