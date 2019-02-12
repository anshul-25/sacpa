<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() 
    {
      var data = google.visualization.arrayToDataTable([
        ['Attendance', 'Marks'],
        <?php
        $n=0;$i=0;
        $csv = array();
        $file = fopen('studentdata_att_aca.csv', 'r');

        while (($result = fgetcsv($file)) !== false)
        {
          $csv[] = $result;
          $n=$n+1;
        }

        fclose($file);
        while ($i < $n)
        {
          echo "[".$csv[$i][0].",".$csv[$i][1]."],";
          $i=$i+1;
        }
        ?>
        ]);

      var options = {
        title: 'Attendance vs. Marks regression line',
        hAxis: {title: 'Attendance', minValue: 60, maxValue: 100},
        vAxis: {title: 'Marks', minValue: 60, maxValue: 100},
        legend: 'none',
        trendlines: { 0: {} }
      };

      var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
  </script>
</head>
<body>
  <!-- <div>
  <?php

  echo "Processed Data from the database - <br>";
  require("student_atten_aca.php");
  echo "<br><br>";
  echo "Algorithm output based on dummy data - <br>";

  ?>
  </div> -->

  <div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>
</html>