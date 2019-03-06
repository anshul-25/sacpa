<?php
require("db.php");
$q="SELECT co.Name, COUNT(co.idCountry) from city c, state s, country co, student st where st.City_id = c.idCity and c.state_id = s.idState and s.country_id = co.idCountry GROUP BY co.idCountry";
$res = $conn->query($q);
$i=0;
while($row = $res->fetch_assoc())
{
	$a[$i][0]=$row["Name"];
	$a[$i][1]=$row["COUNT(co.idCountry)"];
	$i=$i+1;
}
?>

<html>
<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = google.visualization.arrayToDataTable([
				['Country', 'Popularity'],
				<?php 
				$k=0;
				while($k<$i)
				{
					echo "['".$a[$k][0]."',".$a[$k][1]."],";
					$k=$k+1;
				}
				?>
				]);

			var options = {
				title: 'Demographic Distribution - Popularity'
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
