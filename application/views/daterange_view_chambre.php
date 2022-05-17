 <link href="<?php echo base_url('assets/css/notify.css')?>" rel="stylesheet">
 <script src="<?php echo base_url('assets/js/notify.js')?>"></script>

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
<button  class="btn btn-default" id = "butangBack"><i class="fa fa-arrow-left"> </i>Retour</button>
<br>
<br>

<div class="row">

  <div class="col-md-3">
    
 <input style="width:300px;" placeholder="rechercher" type="search" name="search" id="searchInput" class="form-control"  required="required">
  </div>

</div>


<br>
<div class="table-responsive">

<div class="box box-body">
    <table id="tabel-detail" class="table table-bordered table-striped">
      <thead>
        <tr>
         <th style="width:44px;"> 
           <button type="button"  data-toggle="tooltip" title="Supprimer tous ce qui est cocher" id="delete_all" name="delete_all" class="btn btn-danger btn-xs">Supp tous</button>
          </th>
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
      <tbody  id="fbody">
        <?php
          foreach ($output as $data) {
            ?>
            <tr>
              <td><input type="checkbox" class="form-check-input" name="checkbox_value" id="delete_checkbox" value="<?php echo $data->id; ?>"></td>
              <td><?php echo $data->id; ?></td>
              <td><?php echo $data->im; ?></td>
              <td><?php echo $data->nom; ?></td>
              <td class="bg-green"><?php echo $data->dateDepot; ?></td>
              <td class="bg-red"><?php echo $data->dateEnvoie; ?></td>
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




$("#modalimport").click(function () { 
    $('#modal_form_imp').modal('show'); // show bootstrap modal
});

$('#butangBack').on('click', function () {
  $.ajax({
    url : "<?php echo base_url();?>welcome/Load_view",
    success: function (result) {
      $('#haha').empty().html(result).fadeIn('slow');
    }});
});
})
</script>

