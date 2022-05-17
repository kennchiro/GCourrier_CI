<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/0.4.5/sweetalert2.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>

   
      <br>
      <br/>

    <div class = "row">

    <div class="col-md-4" style="padding: 0;">
        <button onclick="add_person()" class="form-control btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Ajouter nouveau C | VISA</button>
    </div>

      <br>
      <br/>
      <br/>
      <div  class="table-responsive">
      <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>IM</th>
            <th>Nom</th>
            <th>Date depot</th>
            <th>Date envoie</th>
            <th>Projet a viser</th>
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
      table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('visa/ajax_list')?>",
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

    function add_person()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Ajouter nouveau C | VISA'); // Set Title to Bootstrap modal title
    }

    function edit_person(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('visa/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
          $('[name="id"]').val(data.id);
          $('[name="im"]').val(data.im);
          $('[name="nom"]').val(data.nom);
          $('[name="dateDepot"]').val(data.dateDepot);
          $('[name="dateEnvoie"]').val(data.dateEnvoie);
          $('[name="dateDecision"]').val(data.dateDecision); //
          $('[name="nature"]').val(data.projetAviser); //
          $("#observation option[value='"+data.observation+"']").prop("selected", "selected");
          $('[name="service_direction"]').val(data.service_direction);
          $('[name="bordereau"]').val(data.bordereau);
          $('[name="analyse"]').val(data.analyse);
          $('[name="ministere"]').val(data.ministere);
          
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Modifier C | VISA'); // Set title to Bootstrap modal title
            
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

    function save()
    {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo site_url('visa/ajax_add_visa')?>";
      }
      else
      {
        url = "<?php echo site_url('visa/ajax_update')?>";
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
               swal(
                'Good job!',
                'Data has been save!',
                'success'
                )
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
              alert('Error adding / update data');
            }
          });
     }

     function delete_person(id) {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('visa/ajax_delete')?>/"+id,
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
         
      }
    }

    function view_person(id) {
          $.ajax({
            url : "<?php echo site_url('visa/list_by_id')?>/" + id,
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


     //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });


  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog" style="width:1000px;height:1500px;font-family: Verdana, Geneva, Tahoma, sans-serif;">
      <div class="modal-content">
        <div class="modal-header" style="background-color:rgb(255,11,11,0.8);">
        <span class="badge badge-success" id="badge" style="float:right; margin-right:-10px; background-color:rgb(50,225,10,0.5);"></span> 
          <h3 class="modal-title">VISA forme </h3> 
          
        </div>
        <div class="modal-body form">

          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id"/>
            <div class="form-body">

               
               <!-- 1er row -->
            <div class="row">
          
             <div class="col-md-4">
              <div class="input-group form-group">
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
          
             <div class="col-md-4 col-sm-10">
              <div class="form-group">
               
                <div class="col-md-9">
                Date d'envoie <input id="dateEnvoie" name="dateEnvoie" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" required>
                </div>
              </div>
             </div>

             <div class="col-md-8 col-sm-9">
               <div class="form-group">
                <div class="col-md-9">
                Service Direction <input style="width:558px;" id="service_direction" name="service_direction" placeholder="Service | direction" class="form-control" type="text" required>
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
						 <option value="Arrivée">Arrivée</option>
						 <option value="Visée">Visée</option>
				</select>
                   </div>
				</div>
             </div>

             <div class="col-md-4 col-sm-6">
              <div class="form-group">     
              <div class="col-md-9">
                Projet a viser <input id="nature" name="nature" placeholder="Projet a viser (nature)" class="form-control" type="text" required>
                </div>
              </div>
             </div>

             <div class="col-md-4 col-sm-6">
              <div class="form-group">     
              <div class="col-md-9">
                Date de decision <input id="dateDecision" name="dateDecision" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" required>
                </div>
              </div>
             </div>
            </div>

            

             <!-- 4eme row -->
            <div class="row">

            
            <div class="col-md-4 col-sm-6">
               <div class="form-group">
               <div class="col-md-9">
                Analyse  <textarea id="analyse" class="form-control" name="analyse" rows="3" required></textarea>
                </div>
              </div>
             </div>

          
             <div class="col-md-4 col-sm-6">
             <div class="form-group"> 
                
                <div class="col-md-9">
               Ministere <textarea id="ministere" class="form-control" name="ministere" rows="3" required></textarea>
                </div>
              </div>
             </div>

            
             <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <div class="col-md-9">
                Bordereau <textarea id="bordereau" class="form-control" name="bordereau" rows="3" required></textarea>
                </div>
              </div>
             </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Enregister</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
</body>
</html>