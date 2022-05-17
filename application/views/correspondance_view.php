    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/notify.css')?>" rel="stylesheet">
    

    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/notify.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
   

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/0.4.5+sweetalert2.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>
   
      <br>
      <br/>

     
      <div  style="text-align:center;"  class="row">
    <!-- pour visee -->
    <div class="col-sm-2">
    <div class="small-box bg-green">

      <div class="inner">
        <h3 id="countv"> <?php echo $countvv; ?> </h3>
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
        <h3 id="counta"> <?php echo $countaa; ?> </h3> 
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
        <h3 id="countrej"> <?php echo $countrejj; ?> </h3> 
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

          

            <form action="<?php echo site_url('correspondance/search_date');?>" method="POST">
              <div class="col-md-4">
              <input name="first_date" id="first_date" class="form-control datepicker" placeholder="Date debut yyyy-mm-dd" type="text">
              </div>

              
              <div class="col-md-4">
              <input  name="second_date" id="second_date" class="form-control datepicker" placeholder="Date Fin yyyy-mm-dd" type="text">
              </div>
           
               <input id="btndepot"   style="height:30px;" type="submit" name="true"   value="D.depot" class="btn btn-success btn-xs">
               <input id="btndenvoie" style="height:30px;" type="submit" name="false"  value="D.envoie" class="btn btn-success btn-xs">
               <input name="xor" data-toggle="tooltip" title="Afficher toutes les listes de date" style="height:30px;" type="submit" id="xor" class="btn btn-info btn-xs" value="Dates" />
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

       <div class = "row">

<br>
<br>
<div class="col-md-2" style="padding: 4;">
    <button onclick="add_corresp()" data-toggle="tooltip" title="Ajouter nouveau "  class="btn btn-success btn-sm"> <img src="images/icons8_Add_32.png" /> </button>
</div>


<div class="col-md-2" style="float:right; margin-right:-6px;">
    <button onclick="viewAllCorresp()" data-toggle="tooltip" title="Voire Toutes les listes completes" id="voireTout" class="btn btn-success btn-sm"> <img src="images/icons8_List_View_32.png" /> </button>
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
            <th>Date de depot</th>
            <th>Date d'envoie</th>
            <th>Ministere</th>
            <th style="width:90px;margin:0px auto;">Deplacer vers visa</th>
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
      
    $('#refresh').unbind('click').click(function () {
    $.ajax({
      url : "<?php echo base_url();?>correspondance/load_view_corresp",
     
      success: function (result) {
        $('#haha').empty().html(result).fadeIn('slow');
      }});
   });

      // apparaisse et disparraisse dataRange 
     $("#dateRangeCollapse").hide();
     $('[data-toggle="tooltip"]').tooltip();

     $("#dateRange").click(function () { 
     $("#dateRangeCollapse").fadeToggle(1000);
     });

    var save_method; //for save method string
    var table;

    $(document).ready(function() {

      
      table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('correspondance/ajax_list')?>",
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
    });

    function add_corresp()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Ajouter nouveau C | CORESP'); // Set Title to Bootstrap modal title
    }


  // function to deplace data into visa via correspondance    
   function deplace_add_to_visa(id) {
 
      save_method = 'deplace';
      $('#form')[0].reset(); // reset form on modals
      $('#re').hide();
      $('#ar').hide();
      $('#corresp').hide();
      $("#visa").css('margin-top', '20px');
      $("#visa").css('margin-left', '20px');
      $("#visa").css('width','20px');
      $("#visa").css('height','20px');
      $("#visa").css('font-size','40px');
      $("#visatxt").html('');
      var a = 1;


      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('correspondance/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
          $('[name="id"]').val(parseInt(data.id) + parseInt(a));
          $('[name="im"]').val(data.im);
          $('[name="nom"]').val(data.nom);
          $('[name="dateDepot"]').val(data.dateDepot);
          $('[name="dateEnvoie"]').val(data.dateEnvoie);
          $(".observation option[value='"+data.observation+"']").prop("selected", "selected");
          $('[name="service_direction"]').val(data.service_direction);
          $('[name="nature"]').val(data.nature);
          $('[name="bordereau"]').val(data.bordereau);
          $('[name="analyse"]').val(data.analyse);
          $('[name="ministere"]').val(data.ministere);
          
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Deplacer vers VISA'); // Set title to Bootstrap modal title
            
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });


   }


    // affectation de toutes les valeurs simplement
    function edit_corresp(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('correspondance/ajax_edit/')?>/" + id,
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

          $('[name="service_direction"]').val(data.service_direction);
          $('[name="nature"]').val(data.nature);
          $('[name="bordereau"]').val(data.bordereau);
          $('[name="analyse"]').val(data.analyse);
          $('[name="ministere"]').val(data.ministere);
          
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Modifier CCH'); // Set title to Bootstrap modal title
            
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
    }

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }

    //function disable button save and datepicker of date decision which come for checkbox 
    disable();

    function save()
    {
     
      var url;

      if(save_method == 'add') 
      {
        url = "<?php echo site_url('correspondance/ajax_add')?>";
      }
      if(save_method == 'update')
      {
        url = "<?php echo site_url('correspondance/ajax_update')?>";
      }
      if(save_method == 'deplace')
      {
        url = "<?php echo site_url('visa/ajax_add_visa')?>";
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


 

function delete_corresp(id) {

  Notify.confirm({
  title : 'Notice',
  html : 'Vous etes sur de supprimer ?',
  ok : function(){
    Notify.suc('OK');
    $.ajax({
            url : "<?php echo site_url('correspondance/ajax_delete')?>/"+id,
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

    function view_person(id) {
          $.ajax({
            url : "<?php echo site_url('correspondance/list_by_id')?>/" + id,
            type: "GET",
            success: function(result)
            {
                $('#haha').empty().html(result).fadeIn('slow');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
    }


    function viewAllCorresp() {
      $.ajax({
        type: "GET",
        url: "<?php echo site_url('correspondance/view_all_corresp')?>",
        success: function (result) {
          $('#haha').empty().html(result).fadeIn('slow');
        },
        error: function (jqXHR, textStatus, errorThrown)
            {
               alert('error');
            }
      });
    }

     //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });


function disable() {
//take out disabled for btnsave and datepicker
    var visa = document.getElementById('visa');
    var datevisa = document.getElementById('dateDecision');
    var save = document.getElementById('btnSave');
    var corresp =  document.getElementById('corresp');

//for correspondance

corresp.onchange = function() {
  if(this.checked){
    save.disabled = false;
  }else{
    save.disabled = true;
  }
}

 // for visa
    visa.onchange = function() {
      if(this.checked){
        save.disabled = false;
        datevisa.disabled = false;
      } else{
        save.disabled = true ;
        datevisa.disabled = true;
      }
    }
}

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog" style="width:1000px;height:1500px;font-family: Verdana, Geneva, Tahoma, sans-serif;">
      <div class="modal-content">
        <div class="modal-header bg-green">
        <span class="badge badge-success" id="badge" style="float:right; margin-right:-10px; background-color:rgb(50,225,10,0.5);"></span> 
          <h3 class="modal-title">Chambre de commerce forme </h3> 
          
        </div>
        <div class="modal-body form">

          <form  id="form" class="form-horizontal">
            <input type="hidden" value="" name="id"/>
            <div class="form-body">

            <div class="col-md-9">
              <div class="form-group">
                <div class="col-md-2">
                 Numero suivant <input id="id" name="id" placeholder="numero" value="<?php echo $maxid+1;?>" class="form-control" type="text"  />
                </div>
              </div>
             </div>
           </div>

               <!-- 1er row -->
            <div class="row">

             <div class="col-md-4">
              <div class="form-group">
               
                <div class="col-md-9">
                Nom de remettant <input id="nom" name="nom" placeholder="nom de l'agent" class="form-control" type="text" required="required">
                </div>
              </div>
             </div>

             <div class="col-md-4">
              <div class="form-group">
                
                <div class="col-md-9">
                IM <input name="im" id="im" placeholder="IM de remettant" class="form-control" type="text" required="required">
                </div>
              </div>
             </div>

             <div class="col-md-4 ">
              <div class="form-group">
                <div class="col-md-9">
                Date de deposition <input id="dateDepot" name="dateDepot" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" required="required">
                </div>
              </div>
             </div>

            </div>


            <!-- 2eme row -->
            <div class="row">
          
             <div class="col-md-4">
              <div class="form-group">
                <div class="col-md-9">
                Date d'envoie <input id="dateEnvoie" name="dateEnvoie" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" required="required">
                </div>
              </div>
             </div>

             <div class="col-md-4">
               <div class="form-group">
                <div class="col-md-9">
                Service Direction <input id="service_direction" name="service_direction" placeholder="Service | direction" class="form-control" type="text" required="required">
                </div>
              </div>
             </div>

             <div class="col-md-4">
              <div class="form-group">
                <div class="col-md-9">
                Date de decision <input id="dateDecision" name="dateDecision" placeholder="choisir visa d'abord" class="form-control datepicker" type="text" disabled="disabled"/>
                </div>
              </div>
             </div>

            </div>
            

             <!-- 3eme row -->
            <div class="row">
          
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


             <div class="col-md-8 col-sm-6">
              <div class="form-group">     
              <div class="col-md-9">
                Nature <input style="width:558px;" id="nature" name="nature" placeholder="Nature (projetAviser)" class="form-control" type="text" required="required">
                </div>
              </div>
             </div>

            </div>

            

             <!-- 4eme row -->
            <div class="row">

            
            <div class="col-md-4 col-sm-6">
               <div class="form-group">
               <div class="col-md-9">
                Analyse  <textarea id="analyse" class="form-control" name="analyse" rows="3" required="required"></textarea>
                </div>
              </div>
             </div>

          
             <div class="col-md-4 col-sm-6">
             <div class="form-group"> 
                
                <div class="col-md-9">
               Ministere <textarea id="ministere" class="form-control" name="ministere" rows="3" required="required"></textarea>
                </div>
              </div>
             </div>

           
             <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <div class="col-md-9">
                Bordereau <textarea id="bordereau" class="form-control" name="bordereau" rows="3" required="required"></textarea>
                </div>
              </div>
             </div>

            </div>
          </form>
        </div>
   

     <div class="custom-control custom-checkbox custom-control-inline bg-gray">
         <input id="visa" class="custom-control-input" style="width:20px;heigth:20px;" type="checkbox" name="visa" value="true">
         <label for="visa" class="custom-control-label">Visa</label>
     </div>

       <div class="custom-control custom-checkbox custom-control-inline bg-gray">
         <input id="corresp" class="custom-control-input" style="width:20px;heigth:20px;"  type="checkbox" name="corresp" value="true">
         <label for="corresp" id="visatxt" class="custom-control-label">Correspondance</label>
       </div>
       
 
        <div class="modal-footer">
          <button type="submit" id="btnSave" disabled="disabled" onclick="save()" class="btn btn-success">Enregister</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
</body>
</html>