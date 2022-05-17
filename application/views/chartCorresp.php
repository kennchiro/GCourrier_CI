<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"   type="text/javascript"></script>




<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

<link href="<?php echo base_url('assets/plugins/morris/morris.css')?>" rel="stylesheet">

<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>

<script src="<?php echo base_url('assets/plugins/morris/morris.min.js')?>"></script>

<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js')?>"></script>
<script src="<?php echo base_url('assets/js/raphael.min.js')?>"></script>



<div class="col-md-8">

   <div id="container" style="">
    <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Correspondance Chart</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body chart-responsive">
      <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
    </div>
    <!-- /.box-body -->
  </div>
    </div>

</div>



<div class="col-md-4">
    <div class="box-body">
      <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
              <th>Subject</th>
              <th>Year</th>
              <th>Percentage</th>
          </tr>
      </thead>
      <tbody>
        <tr>
            <td>Bahasa Melayu</td>
            <td>2016</td>
            <td>0.7%</td>
        </tr>
        <tr>
            <td>English</td>
            <td>2016</td>
            <td>8.5 %</td>
        </tr>
        <tr>
        <td>Mathematics</td>
            <td>2016</td>
            <td>45 %</td>
        </tr>
        <tr>
            <td>Physics</td>
            <td>2016</td>
            <td>6.2 %</td>
        </tr>
        <tr>
            <td>Account</td>
            <td>2016</td>
            <td>12.8 %</td>
        </tr>
        <tr>
            <td>Biology</td>
            <td>2016</td>
            <td>26.8 %</td>
        </tr>
    </table>
</div>
</div>

<script>

    $(function () {
      var donut;
      $(document).ready(function() {
      donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a"],
      data: [
        {label: "Courrier visee", value: <?php echo $countvv;?> },
        {label: "Courrier rejeter", value: <?php echo $countrejj;?> },
        {label: "Courrier arrivee", value: <?php echo $countaa;?> }
      ],
      hideHover: 'auto'
    });
      });

});

</script>














