    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/notify.css')?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/notify.js')?>"></script>
    

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/0.4.5/sweetalert2.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>
 
     
    <div  style="text-align:center;"  class="row">
    <!-- pour visee -->
    <div class="col-sm-2">
    <div class="small-box bg-green">

      <div class="inner">
        <h3 id="countv"> <?php echo $countv; ?> </h3>
        <p>Dossier visée</p>
      </div>

      <div class="icon">
      <img style="margin-top:-36px;" src="images/icons8_viewed_32.png" alt="next"/>
      </div>

      <a href="#" class="small-box-footer"></a>
    </div>
    </div>

     <!-- pour arrivee -->
     <div class="col-sm-2">
      <div class="small-box bg-green">
      <div class="inner">
        <h3 id="counta"> <?php echo $counta; ?> </h3> 
        <p>Dossier arrivée</p>
      </div>
      <div class="icon">
      <img style="margin-top:-36px;" src="images/icons8_Create_New_Child_Post_32.png" alt="next"/>
      </div>
      <a href="#" class="small-box-footer"></a>
    </div> 
    </div>

     <!-- pour rejetee -->
   <div class="col-sm-2">
    <div class="small-box bg-green">
      <div class="inner">
        <h3 id="countrej"> <?php echo $countrej; ?> </h3> 
        <p>Dossier rejeté</p>
      </div>
      <div class="icon">
      <img style="margin-top:-36px;" src="images/icons8_Refuse_32.png" alt="next"/>
      </div>
      <a href="#" class="small-box-footer"></a>
    </div> 
  </div>

  <div class="col-sm-6">
    <div class="bg-white">
     
    <div id="dateRangeCollapse" class="panel panel-default" style="height:110px;">
      <div class="panel-heading bg-green">Recherche entre deux date</div>
      <div class="panel-body">
      <div class="row">

             <div class="form-group" style="margin-left:10px;">
              <div class="row">

          

            <form action="<?php echo site_url('welcome/search_date');?>" method="POST">
              <div class="col-md-4">
              <input name="first_date" id="first_date" class="form-control datepicker" placeholder="Date debut yyyy-mm-dd" type="text">
              </div>

              
              <div class="col-md-4">
              <input  name="second_date" id="second_date" class="form-control datepicker" placeholder="Date Fin yyyy-mm-dd" type="text">
              </div>
               
              <div>
               <input id="btndepot" style="height:30px;"  type="submit" name="true"   value="D.depot" class="btn btn-success btn-xs">
               <input id="btndenvoie" style="height:30px;" type="submit" name="false"  value="D.envoie" class="btn btn-success btn-xs">
               <input name="xor" data-toggle="tooltip" title="Afficher toutes les listes de date" style="height:30px;" type="submit" id="xor" class="btn btn-info btn-xs" value="Dates" />
              </div>
               
          
             </form> 

               </div>
              </div>
             </div>
             
      </div>
    </div>
     
      <a href="#" class="small-box-footer"></a>
    </div> 
  </div>



       </div>

    
      <br>
      <br>

    <div class = "row">

    <div class="col-md-2" style="padding: 4;">
        <button onclick="add_person()" data-toggle="tooltip" title="Ajouter nouveau"  class="btn btn-success btn-sm"> <img src="images/icons8_Add_32.png" /> </button>
   </div>


    <div class="col-md-2" style="float:right; margin-right:-6px;">
        <button onclick="viewAllChambre()" data-toggle="tooltip" title="Voire Toutes les listes completes" id="voireTout" class="btn btn-success btn-sm"> <img src="images/icons8_List_View_32.png" /> </button>
        <button data-toggle="tooltip" title="Recherche entre 2 dates" id="dateRange" class="btn btn-success btn-sm"> <img src="images/icons8_Calendar_32.png" /> </button>
        <a data-toggle="tooltip" title="Actualiser" type="button" id="refresh" type="button" class="btn btn-success btn-sm"> <img src="images/icons8_Refresh_32.png" alt=""> </a>
     </div>
  </div>


      <br>
 
      <div  class="table-responsive">
      <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>IM</th>
            <th>Nom</th>
            <th>Date depot</th>
            <th>Date envoie</th>
            <th style="width:189px;">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
       </div>
     
    </div>


  </div>


  <script type="text/javascript">
  

    var save_method; //for save method string
    var table;

    $(document).ready(function() {
      
   
  

     // apparaisse et disparraisse dataRange 
     $("#dateRangeCollapse").hide();
     $('[data-toggle="tooltip"]').tooltip();

     $("#dateRange").click(function () { 
     $("#dateRangeCollapse").fadeToggle(1000);
     });
       
  
  function reloadAjax() {
    $.ajax({
      url : "<?php echo base_url();?>welcome/Load_view",
      success: function (result) {
        $('#haha').empty().html(result).fadeIn('slow');
      }});
  }

   $('#refresh').unbind('click').click(function () {
    $.ajax({
      url : "<?php echo base_url();?>welcome/Load_view",
     
      success: function (result) {
        $('#haha').empty().html(result).fadeIn('slow');
      }});
   });


    table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
          url: "<?php echo site_url('welcome/ajax_list')?>",
          type: "POST",
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
 

       
      

    });

 
   
    
 
  
    // function to make dateRange    
    // $.fn.DataTable.ext.search.push(
    //     function (settings, data, dataIndex) {
    //         var min = $('#first_date').val();
    //         var max = $('#second_date').val();
    //         var startDate = new Date(data[4]);
    //         if (min == null && max == null) { return true; }
    //         if (min == null && startDate <= max) { return true;}
    //         if(max == null && startDate >= min) {return true;}
    //         if (startDate <= max && startDate >= min) { return true; }
    //         return false;
    //     }

    //     );

       
    //   $("#first_date").datepicker({ 
    //     autoclose: true,
    //     todayHighlight: true,
    //     format: "yyyy-mm-dd",
    //     onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
          
    //   $("#second_date").datepicker({ 
    //     autoclose: true,
    //     todayHighlight: true,
    //     format: "yyyy-mm-dd",
    //     onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
       

    //         // Event listener to the two range filtering inputs to redraw on input
    //         $('#first_date, #second_date').change(function () {
    //           table.draw();
    //         });


    function add_person()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal().slideUp(1000).show(); // show bootstrap modal
      $('.modal-title').text('Ajouter nouveau CCH'); // Set Title to Bootstrap modal title
    }

    function view_chambre(id) {
          $.ajax({
            url : "<?php echo site_url('welcome/list_by_id')?>/" + id,
            type: "GET",
            success: function(result)
            {
                $('#haha').empty().html(result).fadeIn('slow');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              Notify.alert('Veuillez remplir toutes les champs !');
            }
        });
    }

   
      
  
     
    function edit_chambre(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('welcome/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
          $('[name="id"]').val(data.id);
          $('[name="im"]').val(data.im);
          $('[name="nom"]').val(data.nom);
          $('[name="dateDepot"]').val(data.dateDepot);
          $('[name="dateEnvoie"]').val(data.dateEnvoie);

          $("#observation option[value='"+data.observation+"']").prop("selected", "selected");

          $('[name="service"]').val(data.service);
          $('[name="numeroCompte"]').val(data.numeroCompte);
          $('[name="bordereau"]').val(data.bordereau);
          $('[name="titulaire"]').val(data.titulaire);
          $('[name="analyse"]').val(data.analyse);
          $('[name="montant"]').val(data.montant);
          $('[name="dateDecision"]').val(data.dateDecision);
          
          

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Modifier CCH'); // Set title to Bootstrap modal title
           


          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            Notify.alert('Veuillez remplir toutes les champs !');
          }
        });
      
    }

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }

  
    
    


    function save()
    {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo site_url('welcome/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('welcome/ajax_update')?>";
      }

       // ajax adding data to database
       $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
               Notify.suc('Ajout avec success');
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
              Notify.alert('Veuillez remplir toutes les champs !');
            }
          });
     }

   
function delete_chambre(id) {

Notify.confirm({
title : 'Notice',
html : 'Vous etes sur de supprimer ?',
ok : function(){
  Notify.suc('OK');
  $.ajax({
          url : "<?php echo site_url('welcome/ajax_delete')?>/"+id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
             //if success reload ajax table
             $('#modal_form').modal('hide');
             reload_table();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
          }
      });
},
cancel : function(){
  Notify.alert('Annuler');
},
focus : function(){
  Notify.alert('focus');
}
});

  }



    function viewAllChambre() {
      $.ajax({
        type: "GET",
        url: "<?php echo site_url('welcome/view_all_chambre')?>",
        success: function (result) {
          $('#haha').empty().html(result).fadeIn('slow');
        },
        error: function (jqXHR, textStatus, errorThrown)
            {
               alert('error');
            }
      });
    }
    
    


    // datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    // function increm() {
    //   a = parseInt("1");
    //   var num = parseInt($("#id").val());

    //   alert(a + num);
    // }

    // increm();

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog" style="width:1000px;height:1500px;font-family: Verdana, Geneva, Tahoma, sans-serif;">
      <div class="modal-content">
        <div class="modal-header bg-green">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Chambre de commerce forme</h3>
        </div>
        <div class="modal-body form">

    <form action="#" id="form" name="frm" class="form-horizontal">
  
       <div class="row">
       <div class="col-md-9">
              <div class="form-group">
                <div class="col-md-2">
                 Numero <input id="id" name="id" placeholder="numero" value="<?php echo $maxid+1;?>" class="form-control" type="text"  />
                </div>
              </div>
             </div>
       </div>
          
  
            <div class="form-body">

               
               <!-- 1er row -->
            <div class="row">
          
             <div class="col-md-4">
              <div class="form-group">
               
                <div class="col-md-9">
                Nom de remettant <input id="nom" name="nom" placeholder="nom de l'agent" class="form-control" type="text" required>
                </div>
              </div>
             </div>

             <div class="col-md-4 col-sm-6">
              <div class="form-group">
                
                <div class="col-md-9">
                IM <input name="im" id="im" placeholder="IM de remettant" class="form-control" type="text" required>
                </div>
              </div>
             </div>

             <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <div class="col-md-9">
                Date de deposition <input id="dateDepot" name="dateDepot" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" required>
                </div>
              </div>
             </div>

            </div>


            <!-- 2eme row -->
            <div class="row">
          
             <div class="col-md-4 col-sm-6">
              <div class="form-group">
               
                <div class="col-md-9">
                Date d'envoie <input id="dateEnvoie" name="dateEnvoie" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" required>
                </div>
              </div>
             </div>

             <div class="col-md-4 col-sm-6">
               <div class="form-group">
                
                <div class="col-md-9">
                Service <input id="service" name="service" placeholder="Service" class="form-control" type="text" required>
                </div>
              </div>
             </div>

             <div class="col-md-4 col-sm-6">
               <div class="form-group">
                
                <div class="col-md-9">
                Numero de compte  <input id="numeroCompte" name="numeroCompte" placeholder="Numero de compte" class="form-control" type="text" required>
                </div>
              </div>
             </div>

            </div>

             <!-- 3eme row -->
            <div class="row">
          
             <div class="col-md-4 col-sm-6">
              <div class="form-group">
               
                <div class="col-md-9">
                Bordereau <input id="bordereau" name="bordereau" placeholder="Bordereau ou son reference" class="form-control" type="text" required>
                </div>
              </div>
             </div>

             <div class="col-md-4 col-sm-6">
              <div class="form-group">
                
              <div class="col-md-9">
                Montant <input id="montant" name="montant" placeholder="Montant en chiffre" class="form-control" type="text" required>
                </div>

              </div>
             </div>

             <div class="col-md-4 col-sm-6">
             <div class="form-group">
              <div class="col-md-9">
                Date de decision<input id="dateDecision" name="dateDecision" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" required>
                </div>
              </div>
             </div>

            </div>

             <!-- 4eme row -->
            <div class="row">
          
             <div class="col-md-4 col-sm-6">
             <div class="form-group"> 
                
                <div class="col-md-9">
                Titulaire <textarea id="titulaire" class="form-control" name="titulaire" rows="3" required></textarea>
                </div>
              </div>
             </div>

             <div class="col-md-4 col-sm-6">
                <div class="form-group">
                <div class="col-md-9">
                Observation 
										<select name="observation" id="observation" class="form-control input-sm" style="width:223px;" id="observation" >
													<option value="arrivée">Arrivée</option>
													<option value="visée">Visée</option>
													<option value="rejeté">Rejeté</option>						
											</select>
                </div>
								</div>
             </div>

             <div class="col-md-4 col-sm-6">
               <div class="form-group">
               <div class="col-md-9">
                Analyse  <textarea id="analyse" class="form-control" name="analyse" rows="3" required></textarea>
                </div>
              </div>
             </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-success btn-sm">Enregister</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annuler</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->


<!-- MOdal import -->

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

</body>
</html> 










  <table class="table table-light"> 
   <thead class="thead-light">
    <tr> <th>id</th> <th>name</th></tr>
  </thead>
  <tbody>
    <tr> <td> 1 </td>  <td> Dave</td> </tr>
    <tr> <td> 2 </td>  <td> Audrey</td> </tr>
    <tr> <td> 1 </td> <td> Dave </td>  </tr>
    <tr> <td> 3 </td> <td>Mario </td> </tr>
  </tbody>
</table>
