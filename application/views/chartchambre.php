<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"   type="text/javascript"></script>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
  <script src="<?php echo base_url('assets/highchart.js')?>"></script>
  <script src="<?php echo base_url('assets/exporting.js')?>"></script>

<div id="container" style="">

</div>
  
<script>


$(function () {
  var chart;
  $(document).ready(function() {

var chart = new Highcharts.Chart({
                colors: ["#7cb5ec", "green", "red"],
                chart: {
                    type: 'column',
                    renderTo: 'container'
                },
        title: {
            text: 'Statistique de lobservation du courrier de CH'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
        {
            name: 'visee',
            data: [ <?php echo $sjv;?> , <?php echo $sfv;?>, <?php echo $smv;?>, <?php echo $sav;?>, <?php echo $smaiv;?>, <?php echo $sjuv;?>, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        },
        {
            name: 'Arrivee',
            data: [<?php echo $sja;?>, <?php echo $sfa;?>,<?php echo $sma;?>, <?php echo $saa;?>, <?php echo $smaia;?>, <?php echo $sjua;?>, 60.4, 47.6, 39.1, 46.8, 51.1]

        },
        {
            name: 'Rejetee',
            data: [<?php echo $sjr;?>, <?php echo $sfr;?>,<?php echo $smr;?>, <?php echo $sar;?>, <?php echo $smair;?>, <?php echo $sjur;?>, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        },
        ]
    });
});

});

</script>




