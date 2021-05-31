<?php
//Priv-Level Check
if (ROLE == 'super') {

start_div('mb-3');
  create_title(str_replace('/',' <i class="fas fa-chevron-right fa-sm"></i> ',$_SERVER['REQUEST_URI']), "warning");
end_div();
?>

<?php start_content();?>
<div class="row mb-3">
  <div class="col-sm-12">
    <div class="card mb-3 is-card-dark">
      <div class="card-body">
        <h5 class="card-title text-muted">Login Attemps</h5>

        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/dark.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>

        <script>
        am4core.ready(function() {
        /**
         * ---------------------------------------
         * This demo was created using amCharts 4.
         *
         * For more information visit:
         * https://www.amcharts.com/
         *
         * Documentation is available at:
         * https://www.amcharts.com/docs/v4/
         * ---------------------------------------
         */

         // Themes begin
        am4core.useTheme(am4themes_dark);
        am4core.useTheme(am4themes_animated);

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        // Set up data source
        //chart.dataSource.url = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-160/sample_data_serial.json";
        chart.dataSource.url = "<?= BASE_PATH ?>/logs/listChart";
        chart.dataSource.parser = new am4core.JSONParser('');
        chart.dataSource.parser.options.emptyAs = 0;
        // uncomment for data update in realtime
        //chart.dataSource.reloadFrequency = 5000;

        // Create axes
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        //dateAxis.renderer.grid.template.location = 0;
        //dateAxis.renderer.minGridDistance = 30;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        function createSeries(field, name) {
          var series = chart.series.push(new am4charts.LineSeries());
          series.dataFields.valueY = field;
          series.dataFields.dateX = "date";
          series.name = name;
          series.tooltipText = "{dateX}: [b]{valueY}[/]";
          series.strokeWidth = 2;
          series.connect = false;
          series.autoGapCount = 3; //in days format

          // Set up tooltip
          series.adapter.add("tooltipText", function(ev) {
            var text = "[bold]{dateX}[/]\n"
            chart.series.each(function(item) {
              text += "[" + item.stroke.hex + "]●[/] " + item.name + ": {" + item.dataFields.valueY + "}\n";
            });
            return text;
          });

          series.tooltip.getFillFromObject = false;
          series.tooltip.background.fill = am4core.color("#fff");
          series.tooltip.label.fill = am4core.color("#00");

          var bullet = series.bullets.push(new am4charts.CircleBullet());
          bullet.circle.stroke = am4core.color("#fff");
          bullet.circle.strokeWidth = 2;

          return series;
        }

        createSeries("success", "Success");
        createSeries("failed", "Failed");
        createSeries("unknown", "Unknown");

        chart.legend = new am4charts.Legend();
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.maxTooltipDistance = 0;

        // uncomment to hide empty value
        //dateAxis.skipEmptyPeriods = true;

        var range = valueAxis.axisRanges.create();
        range.value = 800;
        range.grid.stroke = am4core.color("#396478");
        range.grid.strokeWidth = .5;
        range.grid.strokeOpacity = 1;
        range.label.inside = true;
        range.label.text = "Goal";
        range.label.fill = range.grid.stroke;
        range.label.align = "right";
        range.label.verticalCenter = "bottom";

        var range2 = valueAxis.axisRanges.create();
        range2.value = 500;
        range2.grid.stroke = am4core.color("#A96478");
        range2.grid.strokeWidth = .5;
        range2.grid.strokeOpacity = 1;
        range2.label.inside = true;
        range2.label.text = "Threshold";
        range2.label.fill = range2.grid.stroke;
        range2.label.align = "right";
        range2.label.verticalCenter = "bottom";

        chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.items[0].icon = "https://cdn1.iconfinder.com/data/icons/hawcons/32/698925-icon-92-inbox-download-512.png";
        chart.exporting.menu.align = "right";
        chart.exporting.menu.verticalAlign = "bottom";

        //chart.scrollbarX = new am4core.Scrollbar();

        }); // end am4core.ready()
        </script>
      </div>
    </div>
  </div>

</div>



   <div class="row mb-3">
     <div class="col-sm-12">
       <div class="card mb-3 is-card-dark">
         <div class="card-body">
           <h5 class="card-title text-muted">Access Logs</h5>
           <?php create_table(array("Username","IP", "Browser","Platform","System","Status","DateTime"),"","tableLogs");?>
         </div>
       </div>
     </div>
   </div>

   <div class="row mb-3">
     <div class="col-sm-12">
       <div class="card mb-3 is-card-dark">
         <div class="card-body">
           <h5 class="card-title text-muted">Access Logs</h5>
           <div class="mb-3"><small><i class="fas fa-circle fa-xs text-warning"></i> <span class="text-white">is your sessionID</span></small></div>
           <?php create_table(array("Username","SessionID","DateTime","Action"),"","tableSession");?>
         </div>
       </div>
     </div>
   </div>

<?php end_content();?>

<script type="text/javascript">
var tableLogs, tableSession;
$(function(){
   tableLogs = $('#tableLogs').DataTable({
      "processing" : true,
      "ajax" : {
         "url" : "<?= BASE_PATH ?>/logs/listData",
         "type" : "POST"
      }
   });
});

$(function(){
   tableSession = $('#tableSession').DataTable({
      "processing" : true,
      "columnDefs":[
        {"orderable":false, "targets":[0,-1]},
        {"width": "50px", "targets": [-1], class: 'text-center'}
      ],
      "ajax" : {
         "url" : "<?= BASE_PATH ?>/logs/listSession",
         "type" : "POST"
      }
   });
});

//Delete Data with AJAX
function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url : "<?= BASE_PATH ?>/logs/delete/"+id,
      type : "GET",
      success : function(data){
        tableSession.ajax.reload();
      },
      error : function(){
        alert("Tidak dapat menghapus data!");
      }
    });
  }
}
</script>
<?php

}else{
  start_content();
  echo '
  <div class="align-items-center danger" style="padding: 10px 12px; background-color: #ffdddd; border-left: 6px solid #f44336;">
    <div class="col text-dark">
      <strong>Unauthorised</strong> access or use shall render the user liable to criminal and/or civil prosecution.
    </div>
  </div>';
  end_content();
}?>
