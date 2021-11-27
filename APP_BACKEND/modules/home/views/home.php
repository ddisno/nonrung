    <!-- FLOT CHARTS -->
  <script src="<?=$this->config->item('vendor')?>bower_components/Flot/jquery.flot.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
  <script src="<?=$this->config->item('vendor')?>bower_components/Flot/jquery.flot.resize.js"></script>
  <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
  <script src="<?=$this->config->item('vendor')?>bower_components/Flot/jquery.flot.pie.js"></script>
  <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
  <script src="<?=$this->config->item('vendor')?>bower_components/Flot/jquery.flot.categories.js"></script>
  <!-- script in views -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$title?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout bg-primary" style="border-left: 5px solid #3c8dbc">
        <h3 style="margin-top: 10px;">ยินดีต้อนรับ</h3>
        <h4 style="font-weight: normal;">คุณ <?=$this->session->userdata('f_name').' '.$this->session->userdata('l_name')?></h4> 
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!-- Morris charts -->
 <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/morris.js/morris.css">
  <script src="<?=$this->config->item('vendor')?>bower_components/raphael/raphael.min.js"></script>
  <script src="<?=$this->config->item('vendor')?>bower_components/morris.js/morris.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      var areaChartData = {};

      var areaChartOptions = {
              //Boolean - If we should show the scale at all
              showScale               : true,
              //Boolean - Whether grid lines are shown across the chart
              scaleShowGridLines      : false,
              //String - Colour of the grid lines
              scaleGridLineColor      : 'rgba(0,0,0,.05)',
              //Number - Width of the grid lines
              scaleGridLineWidth      : 1,
              //Boolean - Whether to show horizontal lines (except X axis)
              scaleShowHorizontalLines: true,
              //Boolean - Whether to show vertical lines (except Y axis)
              scaleShowVerticalLines  : true,
              //Boolean - Whether the line is curved between points
              bezierCurve             : true,
              //Number - Tension of the bezier curve between points
              bezierCurveTension      : 0.3,
              //Boolean - Whether to show a dot for each point
              pointDot                : false,
              //Number - Radius of each point dot in pixels
              pointDotRadius          : 4,
              //Number - Pixel width of point dot stroke
              pointDotStrokeWidth     : 1,
              //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
              pointHitDetectionRadius : 20,
              //Boolean - Whether to show a stroke for datasets
              datasetStroke           : true,
              //Number - Pixel width of dataset stroke
              datasetStrokeWidth      : 2,
              //Boolean - Whether to fill the dataset with a color
              datasetFill             : true,
              //String - A legend template
              legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
              //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio     : true,
              //Boolean - whether to make the chart responsive to window resizing
              responsive              : true
      }

      var barChartOptions  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
      }


      var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
      var lineChart                = new Chart(lineChartCanvas)
      var lineChartOptions         = areaChartOptions

      var barChartCanvas           = $('#barChart').get(0).getContext('2d')
      var barChart                 = new Chart(barChartCanvas)
      var barChartData             = areaChartData
      

      function respondCanvas(data) {

          // line chart
          lineChartOptions.datasetFill = false
          lineChart.Line(data, lineChartOptions)

          // bar chart
          data.datasets[1].fillColor   = '#00a65a'
          data.datasets[1].strokeColor = '#00a65a'
          data.datasets[1].pointColor  = '#00a65a'
          barChartOptions.datasetFill = false
          barChart.Bar(data, barChartOptions)
      }

      function getdata(year='',phase=''){
        $.ajax({
          url: '<?=base_url()?>home/getdata',
          type: 'get',
          dataType: 'json',
          data:{year:year,phase:phase},
          success:function(data){
            areaChartData = {
              labels  : data[4],
              datasets: [
                {
                  label               : 'จอง',
                  fillColor           : '#00c0ef',
                  strokeColor         : '#00c0ef',
                  pointColor          : '#00c0ef',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data[0]
                },
                {
                  label               : 'เข้าใช้บริการ',
                  fillColor           : '#00a65a',
                  strokeColor         : '#00a65a',
                  pointColor          : '#00a65a',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : data[1]
                },
                {
                  label               : 'ยกเลิก',
                  fillColor           : '#dd4b39',
                  strokeColor         : '#dd4b39',
                  pointColor          : '#dd4b39',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : data[2]
                },
                 {
                  label               : 'หมดอายุ',
                  fillColor           : '#f39c12',
                  strokeColor         : '#f39c12',
                  pointColor          : '#f39c12',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : data[3]
                },
              ]
            }
            console.log(data);
            respondCanvas(areaChartData);
          }
        })      
      }

      getdata();

      $('#save').click(function(event) {
        var year  = $('#year').val();
        var phase = $('#phase').val();

        getdata(year,phase);
      });
  })
  </script>

  