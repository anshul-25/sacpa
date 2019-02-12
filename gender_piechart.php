<?php

  require("db.php");
  $male = "Select count(title) from student where title = 'Mr'";
  $female = "Select count(title) from student where title = 'Ms' or title = 'Mrs'";
  $other = "Select count(title) from student where title ='None'";

  $res = $conn->query($male);
  $m = $res->fetch_assoc();

  $res = $conn->query($female);
  $f = $res->fetch_assoc();

  $res = $conn->query($other);
  $o = $res->fetch_assoc();

?>


<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'No of students'],
          ['Male', <?php echo $m["count(title)"]; ?>],
          ['Female', <?php echo $f["count(title)"]; ?>],
          ['Other', <?php echo $o["count(title)"]; ?>]
        ]);

        var options = {
          title: 'Gender Distribution'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>