<?php

  require("db.php");
  $q="SELECT co.Name, COUNT(co.idCountry) from city c, state s, country co, student st where st.City_id = c.idCity and c.state_id = s.idState and s.country_id = co.idCountry GROUP BY co.idCountry";

  $res = $conn->query($q);

?>



<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          <?php
          while($row = $res->fetch_assoc())
          {
            echo "['".$row["Name"]."',".$row["COUNT(co.idCountry)"]."],";
          }
          ?>
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="regions_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>